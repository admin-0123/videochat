<div>
    <section id="contact" class="contact section-bg">
        <div class="container">

            <div class="section-title">
                <h2 class="mb-3 text-center">Register for event</h2>
            </div>

            <div class="row">
            <div class="col-lg-12 mt-4 mt-md-0">
                <form method="post" role="form" wire:submit.prevent="register" class="php-email-form">
                <div class="form-row">
                    <div class="col-md-6 form-group">
                        <input type="text" name="name" class="form-control" id="name" wire:model.debounce.500ms="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" {{ $otp_sent ? 'readonly' : ''}} />
                        <div class="validate"></div>
                        @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <input type="text" class="form-control" name="email" id="email" wire:model.debounce.500ms="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" {{ $otp_sent ? 'readonly' : ''}}  />
                        <div class="validate"></div>
                        @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                @if($otp_sent)
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="otp" class="form-control" id="otp" wire:model.debounce.500ms="otp" placeholder="Please enter 6 digit OTP" data-rule="minlen:6" data-msg="Please enter 6 digit OTP" />
                            <div class="validate"></div>
                            @error('otp') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                    </div>
                @endif
                <div class="mb-3">
                    @if ($response_message)
                        <p class="{{ $error ? 'text-danger' : 'text-success' }}">{{$response_message}}</p>
                    @endif
                </div>
                <div class="text-center"><button type="submit">Register</button></div>
                </form>
            </div>

            </div>

        </div>
    </section>
</div>
