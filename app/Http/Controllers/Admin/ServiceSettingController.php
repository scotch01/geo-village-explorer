<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceSetting;
use App\Models\ServiceMethod;
use App\Models\Desa;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = ServiceSetting::with('desa')
            ->orderBy(
                Desa::select('nama_desa')
                    ->whereColumn(
                        'desas.id',
                        'service_settings.desa_id'
                    )
            )
            ->get();

        return view(
            'admin.service-setting.index',
            [
                'services' => $services,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.service-setting.create',
            [
                'desas' => Desa::orderBy('nama_desa')->get(),
            ]
        );
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        DB::transaction(function () use ($request, $validated) {

            /**
             * Upload Maklumat
             */
            if ($request->hasFile('maklumat_image')) {

                $validated['maklumat_image'] = $this->uploadImage(
                    $request->file('maklumat_image')
                );
            }

            $service = ServiceSetting::create([
                'desa_id'         => $validated['desa_id'],
                'maklumat_image'  => $validated['maklumat_image'] ?? null,
                'whatsapp'        => $validated['whatsapp'] ?? null,
                'email'           => $validated['email'] ?? null,
                'sop_url'         => $validated['sop_url'] ?? null,
                'is_active'       => $validated['is_active'] ?? true,
            ]);

            /**
             * Simpan seluruh metode
             */
            foreach ($request->methods ?? [] as $index => $method) {

                $imagePath = null;

                if (
                    isset($method['image']) &&
                    $method['image']
                ) {
                    $imagePath = $this->uploadImage(
                        $method['image']
                    );
                }

                $service->methods()->create([

                    'title' => $method['title'],

                    'image_path' => $imagePath,

                    'url' => $method['url'],

                    'sort_order' => $index + 1,

                ]);
            }
        });

        return redirect()
            ->route('admin.service-setting.index')
            ->with(
                'success',
                'Layanan berhasil ditambahkan.'
            );
    }

    /**
     * Show the form for editing.
     */
    public function edit(
        ServiceSetting $serviceSetting
    ) {
        $serviceSetting->load('methods');

        return view(
            'admin.service-setting.edit',
            [

                'service' => $serviceSetting->load(
                    'methods'
                ),

                'desas' => Desa::orderBy(
                    'nama_desa'
                )->get(),

            ]
        );
    }

    /**
     * Update.
     */
    public function update(
        Request $request,
        ServiceSetting $serviceSetting
    )
    {
        $validated = $this->validateData(
            $request,
            $serviceSetting
        );

        DB::transaction(function () use (
            $request,
            $validated,
            $serviceSetting
        ) {

            /**
             * Simpan method lama
             */
            $oldMethods = $serviceSetting
                ->methods()
                ->orderBy('sort_order')
                ->get();

            /**
             * Upload maklumat baru
             */
            if ($request->hasFile('maklumat_image')) {

                if (
                    $serviceSetting->maklumat_image &&
                    Storage::disk('public')->exists(
                        $serviceSetting->maklumat_image
                    )
                ) {
                    Storage::disk('public')->delete(
                        $serviceSetting->maklumat_image
                    );
                }

                $validated['maklumat_image'] = $this->uploadImage(
                    $request->file('maklumat_image')
                );
            }

            /**
             * Update Service Setting
             */
            $serviceSetting->update([

                'desa_id'
                    => $validated['desa_id'],

                'maklumat_image'
                    => $validated['maklumat_image']
                    ?? $serviceSetting->maklumat_image,

                'whatsapp'
                    => $validated['whatsapp'],

                'email'
                    => $validated['email'],

                'sop_url'
                    => $validated['sop_url'],

                'is_active'
                    => $validated['is_active'] ?? true,

            ]);

            /**
             * Hapus seluruh row method lama
             */
            $serviceSetting
                ->methods()
                ->delete();

            /**
             * Insert ulang method
             */
            foreach (
                $request->methods ?? []
                as $index => $method
            ) {

                $oldMethod =
                    $oldMethods[$index] ?? null;

                $imagePath =
                    $oldMethod?->image_path;

                /**
                 * Upload image baru
                 */
                if (
                    isset($method['image']) &&
                    $method['image']
                ) {

                    if (
                        $oldMethod &&
                        $oldMethod->image_path &&
                        Storage::disk('public')->exists(
                            $oldMethod->image_path
                        )
                    ) {

                        Storage::disk('public')->delete(
                            $oldMethod->image_path
                        );

                    }

                    $imagePath = $this->uploadImage(
                        $method['image']
                    );
                }

                $serviceSetting
                    ->methods()
                    ->create([

                        'title'
                            => $method['title'],

                        'image_path'
                            => $imagePath,

                        'url'
                            => $method['url'],

                        'sort_order'
                            => $index + 1,

                        'is_active'
                            => true,

                    ]);
            }

            /**
             * Hapus image method yang sudah tidak dipakai
             */
            if (
                count($oldMethods)
                >
                count($request->methods ?? [])
            ) {

                foreach (
                    $oldMethods->slice(
                        count($request->methods ?? [])
                    )
                    as $deletedMethod
                ) {

                    if (
                        $deletedMethod->image_path &&
                        Storage::disk('public')->exists(
                            $deletedMethod->image_path
                        )
                    ) {

                        Storage::disk('public')->delete(
                            $deletedMethod->image_path
                        );

                    }

                }

            }

        });

        return redirect()
            ->route(
                'admin.service-setting.index'
            )
            ->with(
                'warning',
                'Layanan berhasil diperbarui.'
            );
    }

    /**
     * Destroy.
     */
    public function destroy(
        ServiceSetting $serviceSetting
    ) {
        $serviceSetting->load('methods');

        if (
            $serviceSetting->maklumat_image &&
            Storage::disk('public')->exists(
                $serviceSetting->maklumat_image
            )
        ) {

            Storage::disk('public')->delete(
                $serviceSetting->maklumat_image
            );
        }

        foreach (
            $serviceSetting->methods
            as $method
        ) {

            if (
                $method->image_path &&
                Storage::disk('public')->exists(
                    $method->image_path
                )
            ) {

                Storage::disk('public')->delete(
                    $method->image_path
                );
            }
        }

        $serviceSetting
            ->methods()
            ->delete();

        $serviceSetting->delete();

        return redirect()
            ->route(
                'admin.service-setting.index'
            )
            ->with(
                'danger',
                'Layanan berhasil dihapus.'
            );
    }

    /**
     * Validation
     */
    private function validateData(
        Request $request,
        ?ServiceSetting $serviceSetting = null
    ) {

        return $request->validate(

            [

                'desa_id' => [

                    'required',

                    'exists:desas,id',

                    Rule::unique(
                        'service_settings',
                        'desa_id'
                    )->ignore(
                        $serviceSetting?->id
                    ),

                ],

                'maklumat_image'
                    => 'nullable|image|max:5120',

                'whatsapp'
                    => 'nullable|string|max:30',

                'email'
                    => 'nullable|email|max:255',

                'sop_url'
                    => 'nullable|url',

                'is_active'
                    => 'nullable|boolean',

                'methods'
                    => 'required|array|min:1',

                'methods.*.title'
                    => 'required|string|max:255',

                'methods.*.image'
                    => 'nullable|image|max:5120',

                'methods.*.url'
                    => 'required|url',

            ],

            [],

            [

                'desa_id'
                    => 'Desa',

                'maklumat_image'
                    => 'Maklumat Pelayanan',

                'whatsapp'
                    => 'Whatsapp',

                'email'
                    => 'Email',

                'sop_url'
                    => 'SOP Permintaan Data',

                'methods'
                    => 'Metode Pelayanan',

                'methods.*.title'
                    => 'Judul Metode',

                'methods.*.image'
                    => 'Gambar Metode',

                'methods.*.url'
                    => 'Link Tujuan',

            ]

        );
    }

    /**
     * Upload & Convert Image
     */
    private function uploadImage($file): string
    {
        $manager = new ImageManager(
            new Driver()
        );

        $image = $manager
            ->read($file)
            ->toWebp(80);

        $filename = uniqid() . '.webp';

        Storage::disk('public')->put(
            "service/{$filename}",
            $image
        );

        return "service/{$filename}";
    }
}