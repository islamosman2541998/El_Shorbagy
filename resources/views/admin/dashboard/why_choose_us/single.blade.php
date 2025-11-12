@extends('admin.app')

@section('title', __('admin.why_choose_us'))
@section('title_page', __('admin.why_choose_us'))

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.why-choose-us.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-9">
                    @foreach ($languages as $key => $locale)
                        <div class="accordion mt-3" id="acc{{ $locale }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="h{{ $locale }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#c{{ $locale }}" aria-expanded="true">
                                        {{ trans('lang.' . \Locale::getDisplayName($locale)) }} ({{ strtoupper($locale) }})
                                    </button>
                                </h2>
                                <div id="c{{ $locale }}" class="accordion-collapse collapse show"
                                    aria-labelledby="h{{ $locale }}">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.title')</label>
                                            <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                value="{{ old($locale . '.title', optional($why_choose_us->translate($locale))->title) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.subtitle')</label>
                                            <input type="text" name="{{ $locale }}[subtitle]" class="form-control"
                                                value="{{ old($locale . '.subtitle', optional($why_choose_us->translate($locale))->subtitle) }}">
                                        </div>

                              
                                        {{-- description ------------------------------------------------------------------------------------- --}}
                                        <div class="row mb-3">
                                            <label for="example-text-input"
                                                class="col-sm-2 col-form-label">{{ trans('admin.description_in') . trans('lang.' . Locale::getDisplayName($locale)) }}
                                            </label>
                                            <div class="col-sm-10 mb-2">
                                                <textarea id="description{{ $key }}" name="{{ $locale }}[description]"> {{ @$why_choose_us->trans->where('locale', $locale)->first()->description }} </textarea>
                                                @if ($errors->has($locale . '.description'))
                                                    <span
                                                        class="missiong-spam">{{ $errors->first($locale . '.description') }}</span>
                                                @endif
                                            </div>

                                            <script type="text/javascript">
                                                CKEDITOR.replace('description{{ $key }}', {
                                                    filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
                                                    filebrowserUploadMethod: 'form'
                                                });
                                            </script>
                                        </div>
                                   
                                    
                                    

                                        <div class="mb-3">
                                            <label>@lang('about.features') ({{ strtoupper($locale) }})</label>

                                            <div id="core-values-{{ $locale }}">
                                                @php
                                                    $existing = old(
                                                        $locale . '.core_values',
                                                        $why_choose_us->translate($locale)->core_values ?? [],
                                                    );
                                                @endphp

                                                @foreach ($existing as $i => $cv)
                                                    <div class="core-value-item mb-2">
                                                        <input type="text"
                                                            name="{{ $locale }}[core_values][{{ $i }}][title]"
                                                            value="{{ $cv['title'] ?? '' }}" placeholder="Title"
                                                            class="form-control mb-1">
                                                        <textarea name="{{ $locale }}[core_values][{{ $i }}][description]" class="form-control"
                                                            placeholder="Description">{{ $cv['description'] ?? '' }}</textarea>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-core">@lang('about.remove')</button>
                                                    </div>
                                                @endforeach


                                                @if (empty($existing))
                                                    <div class="core-value-item mb-2">
                                                        <input type="text"
                                                            name="{{ $locale }}[core_values][0][title]"
                                                            placeholder="Title" class="form-control mb-1">
                                                        <textarea name="{{ $locale }}[core_values][0][description]" class="form-control" placeholder="Description"></textarea>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-core">@lang('about.remove')</button>
                                                    </div>
                                                @endif
                                            </div>

                                            <button type="button" class="btn btn-sm btn-primary mt-2 add-core"
                                                data-locale="{{ $locale }}">@lang('about.add_feature')</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-3">
                    <div class="card p-3">
                        <h5>@lang('admin.settings')</h5>

                     
                        <div class="mb-3">
                            <label class="form-label">@lang('about.image')</label>
                            @if ($why_choose_us->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $why_choose_us->image) }}"
                                        style="width:100%; max-height:150px; object-fit:cover;">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                       
                    </div>
                </div>
                <div class="row mb-3 text-end">
                    <div>
                     
                        <button type="submit"
                            class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.save')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
@endsection
<script>
    document.addEventListener('click', function(e) {
        if (e.target.matches('.add-core')) {
            const locale = e.target.dataset.locale;
            const container = document.getElementById('core-values-' + locale);
            const index = container.querySelectorAll('.core-value-item').length;
            const tpl = document.createElement('div');
            tpl.className = 'core-value-item mb-2';
            tpl.innerHTML = `
            <input type="text" name="${locale}[core_values][${index}][title]" placeholder="Title" class="form-control mb-1">
            <textarea name="${locale}[core_values][${index}][description]" class="form-control" placeholder="Description"></textarea>
            <button type="button" class="btn btn-sm btn-danger remove-core">Remove</button>
        `;
            container.appendChild(tpl);
        }

        if (e.target.matches('.remove-core')) {
            e.target.closest('.core-value-item').remove();

        }
    });
</script>
