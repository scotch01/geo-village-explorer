<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BangunanLainnya;
use Illuminate\Validation\Rule;
use App\Models\Tempat;
use App\Constants\BangunanLainnya\Kategori;
use App\Constants\Desa\Dusun;

class BangunanLainnyaController extends Controller
{

    public function create(
        Tempat $tempat
    )
    {
        if (
            !auth()->user()->canEditTempat(
                $tempat
            )
        ) {
            abort(403);
        }

        $desa = auth()->user()->desa;

        return view(
            'admin.bangunan-lainnya.create',
            [

                'tempat' => $tempat,

                'desa'   => $desa,

                'kategori'
                    => Kategori::OPTIONS,

                'dusuns'
                    => Dusun::OPTIONS[$tempat->id_desa] ?? [],

            ]
        );
    }

    public function store(
        Request $request,
        Tempat $tempat
    )
    {
        if (
            !auth()->user()->canEditTempat(
                $tempat
            )
        ) {
            abort(403);
        }

        if (
            $tempat->bangunanLainnya
        ) {

            return redirect()
                ->route(
                    'admin.tempat.survey',
                    $tempat
                )
                ->with(
                    'error',
                    'Data bangunan lainnya sudah tersedia'
                );
        }

        $validated = $this->validateData(
            $request,
            $tempat
        );

        $validated['tempat_id']
            = $tempat->id;

        BangunanLainnya::create(
            $validated
        );

        return redirect()
            ->route(
                'admin.bangunan-lainnya.show',
                $tempat
            )
            ->with(
                'success',
                'Data bangunan lainnya berhasil disimpan'
            );
    }

    public function show(
        Tempat $tempat
    )
    {
        if (
            !auth()->user()->canViewTempat(
                $tempat
            )
        ) {
            abort(403);
        }

        $tempat->load(
            'bangunanLainnya'
        );

        abort_if(
            !$tempat->bangunanLainnya,
            404
        );

        return view(
            'admin.bangunan-lainnya.show',
            [

                'tempat'
                    => $tempat,

                'bangunanLainnya'
                    => $tempat->bangunanLainnya,

                'kategori'
                    => Kategori::OPTIONS,

            ]
        );
    }

    public function edit(
        Tempat $tempat
    )
    {
        if (
            !auth()->user()->canEditTempat(
                $tempat
            )
        ) {
            abort(403);
        }

        $bangunanLainnya = $tempat
            ->bangunanLainnya;

        if (
            !$bangunanLainnya
        ) {
            abort(404);
        }

        return view(
            'admin.bangunan-lainnya.edit',
            [

                'tempat'
                    => $tempat,

                'bangunanLainnya'
                    => $bangunanLainnya,

                'kategori'
                    => Kategori::OPTIONS,

                'dusuns'
                    => Dusun::OPTIONS[$tempat->id_desa] ?? [],

            ]
        );
    }

    public function update(
        Request $request,
        Tempat $tempat
    )
    {
        if (
            !auth()->user()->canEditTempat(
                $tempat
            )
        ) {
            abort(403);
        }

        $bangunanLainnya =
            $tempat->bangunanLainnya;

        if (
            !$bangunanLainnya
        ) {
            abort(404);
        }

        $validated = $this->validateData(
            $request,
            $tempat,
            $bangunanLainnya
        );

        /**
         * Update data Bangunan Lainnya
         */

        $bangunanLainnya->update(
            $validated
        );

        return redirect()
            ->route(
                'admin.bangunan-lainnya.show',
                $tempat
            )
            ->with(
                'warning',
                'Data bangunan lainnya berhasil diperbarui'
            );
    }

    public function destroy(
        Tempat $tempat
    )
    {
        if (
            !auth()->user()->isMasterAdmin()
        ) {
            abort(403);
        }

        $bangunanLainnya =
            $tempat->bangunanLainnya;

        if (
            !$bangunanLainnya
        ) {
            abort(404);
        }

        $bangunanLainnya->delete();

        return redirect()
            ->route(
                'admin.tempat.survey',
                $tempat
            )
            ->with(
                'danger',
                'Data bangunan lainnya berhasil dihapus'
            );
    }

    private function validateData(
        Request $request,
        Tempat $tempat,
        ?BangunanLainnya $bangunanLainnya = null
    )
    {
        $dusuns =
            Dusun::OPTIONS[$tempat->id_desa] ?? [];
    /**
     * Validasi akurasi GPS maksimal 80 meter
     * Hanya dilakukan jika pengguna melakukan tagging ulang.
     */
    $gpsChanged = $bangunanLainnya
        ? (
            (float) $request->latitude !== (float) $bangunanLainnya->latitude ||
            (float) $request->longitude !== (float) $bangunanLainnya->longitude
        )
        : true;

    if (
        $gpsChanged &&
        $request->filled('akurasi') &&
        $request->akurasi > 80
    ) {

        return back()
            ->withInput()
            ->with(
                'danger',
                'Tagging lokasi gagal. Akurasi GPS melebihi 80 meter. Silakan lakukan tagging ulang di area terbuka dan pastikan jaringan internet aktif.'
            )
            ->throwResponse();

    }

    return $request->validate(

        [

            'nama_infrastruktur'
                => 'required|string|max:255',

            'kategori' => [

                'required',

                Rule::in(
                    array_keys(
                        Kategori::OPTIONS
                    )
                ),

            ],

            'provinsi' => 'required|string|max:255',

            'kabupaten' => 'required|string|max:255',

            'kecamatan' => 'required|string|max:255',

            'desa' => 'required|string|max:255',

            'dusun' => [
                'required',
                Rule::in($dusuns),
            ],

            'alamat'
                => 'required|string',

            'email'
                => 'nullable|email|max:255',

            'website'
                => 'nullable|string|max:255',

            'latitude'
                => 'nullable|numeric|between:-90,90',

            'longitude'
                => 'nullable|numeric|between:-180,180',

            'akurasi'
                => 'nullable|numeric|min:0',

        ],

        [],

        [

            'nama_infrastruktur'
                => '1. Nama Infrastruktur',

            'kategori'
                => '2. Kategori',

            'alamat'
                => '3. Alamat',

            'email'
                => '4. Email',

            'website'
                => '5. Website',

            'latitude'
                => '6. Latitude',

            'longitude'
                => '6. Longitude',

            'akurasi'
                => '6. Akurasi GPS',

        ]

    );
}
}
