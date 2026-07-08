@php
    $service ??= null;

    $existingMethods = old(
        'methods',
        $service?->methods
            ? $service->methods
                ->map(function ($method) {
                    return [
                        'title' => $method->title,
                        'url' => $method->url,
                        'preview' => $method->image_path ? asset('storage/' . $method->image_path) : null,
                    ];
                })
                ->toArray()
            : [
                [
                    'title' => '',
                    'url' => '',
                    'preview' => null,
                ],
            ],
    );
@endphp

<div x-data="serviceSettingForm(
    '{{ $service?->maklumat_image ? asset('storage/' . $service->maklumat_image) : '' }}'
)" x-init='methods = @json($existingMethods)'>

    {{-- ========================= --}}
    {{-- INFORMASI LAYANAN --}}
    {{-- ========================= --}}
    <div class="p-8 space-y-6">

        <div>

            <label class="text-sm font-semibold text-slate-700">
                Desa
            </label>

            <select name="desa_id" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50" required>

                <option value="">
                    Pilih Desa
                </option>

                @foreach ($desas as $desa)
                    <option value="{{ $desa->id }}" @selected(old('desa_id', $service?->desa_id) == $desa->id)>

                        {{ $desa->nama_desa }}

                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <label class="text-sm font-semibold text-slate-700">
                Maklumat Pelayanan
            </label>

            <input type="file" name="maklumat_image" accept="image/*" @change="previewMaklumat"
                class="block w-full mt-2 text-sm text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-2xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors cursor-pointer border border-slate-200 rounded-2xl bg-slate-50">

            <template x-if="maklumatPreview">

                <img :src="maklumatPreview" class="mt-4 rounded-2xl border border-slate-200 max-h-72">

            </template>

        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <label class="text-sm font-semibold text-slate-700">
                    WhatsApp
                </label>

                <input type="text" name="whatsapp" value="{{ old('whatsapp', $service?->whatsapp) }}"
                    class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

            </div>

            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Email
                </label>

                <input type="email" name="email" value="{{ old('email', $service?->email) }}"
                    class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

            </div>

        </div>

        <div>

            <label class="text-sm font-semibold text-slate-700">
                SOP Permintaan Data
            </label>

            <input type="url" name="sop_url" value="{{ old('sop_url', $service?->sop_url) }}"
                class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

        </div>

        <div>

            <label class="text-sm font-semibold text-slate-700">
                Status
            </label>

            <select name="is_active" class="w-full mt-2 rounded-2xl border-slate-200 bg-slate-50">

                <option value="1" @selected(old('is_active', $service?->is_active ?? 1) == 1)>
                    Aktif
                </option>

                <option value="0" @selected(old('is_active', $service?->is_active) == 0)>
                    Nonaktif
                </option>

            </select>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- METODE PELAYANAN --}}
    {{-- ========================= --}}
    <div class="border-t border-slate-100 p-8">

        <div class="flex items-center justify-between mb-6">

            <div>

                <h3 class="text-xl font-bold text-slate-900">
                    Metode Pelayanan
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Tambahkan metode pelayanan yang ditampilkan pada halaman publik.
                </p>

            </div>

            <button type="button" @click="addMethod()"
                class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">

                Tambah Metode

            </button>

        </div>

        <template x-for="(method,index) in methods" :key="index">

            <div class="mb-8 rounded-3xl border border-slate-200 p-6 bg-slate-50">

                <div class="flex items-center justify-between mb-5">

                    <h4 class="font-bold text-slate-800" x-text="'Metode '+(index+1)">
                    </h4>

                    <button type="button" @click="removeMethod(index)" x-show="methods.length>1"
                        class="text-red-600 text-sm font-semibold">

                        Hapus

                    </button>

                </div>

                <div class="space-y-5">

                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            Judul

                        </label>

                        <input type="text" :name="'methods[' + index + '][title]'" x-model="method.title"
                            class="w-full mt-2 rounded-2xl border-slate-200 bg-white" required>

                    </div>

                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            Gambar

                        </label>

                        <input type="file" accept="image/*" :name="'methods[' + index + '][image]'"
                            @change="previewImage($event,index)"
                            class="block w-full mt-2 text-sm text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-2xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:transition-colors cursor-pointer border border-slate-200 rounded-2xl bg-slate-50">

                    </div>

                    <template x-if="method.preview">

                        <img :src="method.preview" class="rounded-2xl border border-slate-200 max-h-60">

                    </template>

                    <div>

                        <label class="text-sm font-semibold text-slate-700">

                            URL Tujuan

                        </label>

                        <input type="url" :name="'methods[' + index + '][url]'" x-model="method.url"
                            class="w-full mt-2 rounded-2xl border-slate-200 bg-white" required>

                    </div>

                </div>

            </div>

        </template>

    </div>

</div>

<script>
    function serviceSettingForm(initialMaklumat = '') {

        return {

            maklumatPreview: initialMaklumat,

            methods: [],

            addMethod() {

                this.methods.push({

                    title: '',

                    url: '',

                    preview: null,

                });

            },

            removeMethod(index) {

                this.methods.splice(index, 1);

            },

            previewMaklumat(event) {

                const file = event.target.files[0];

                if (!file) {

                    return;

                }

                this.maklumatPreview =
                    URL.createObjectURL(file);

            },

            previewImage(event, index) {

                const file = event.target.files[0];

                if (!file) {

                    return;

                }

                this.methods[index].preview =
                    URL.createObjectURL(file);

            }

        }

    }
</script>
