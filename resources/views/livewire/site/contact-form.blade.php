<div class="bg-primary h-100 p-5">
  
    <form wire:submit.prevent="submit">

        <div class="row g-3">


            <div class="col-6">
                <input type="text" wire:model.defer="name" class="form-control bg-light border-0 px-4 contactInput"
                    placeholder="@lang('home.full_name')">
                @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <input type="text" wire:model.defer="phone" class="form-control bg-light border-0 px-4 contactInput"
                    placeholder="@lang('home.phone')">
                @error('phone')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>



            <div class="col-12">
                <input type="email" wire:model.defer="email" class="form-control bg-light border-0 px-4 contactInput"
                    placeholder="@lang('home.email')">
                @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <input type="text" wire:model.defer="subject"
                    class="form-control bg-light border-0 px-4 contactInput" placeholder="@lang('home.subject')">
                @error('subject')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
           

            <div class="col-12">
                <textarea wire:model.defer="message" class="form-control bg-light border-0 px-4 py-3" rows="2"
                    placeholder="@lang('home.message')"></textarea>
                @error('message')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="col-12">
                <button wire:loading.attr="disabled" class="btn btn-secondary w-100 py-3"
                    type="submit">
                    <span wire:loading.remove>@lang('home.send')</span>
                    <span wire:loading>... @lang('home.sending')</span>
                </button>
            </div>

        </div>
    </form>
</div>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
    <div id="livewireToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white rounded-2 bg-success "></div>
    </div>
</div>

<script>
    window.addEventListener('contact-sent', event => {
        const toastEl = document.getElementById('livewireToast');
        toastEl.querySelector('.toast-body').textContent = event.detail.message;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>


