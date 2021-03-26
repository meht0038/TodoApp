
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="title">
            <h1 class="text-6xl pb-6">Create Account</h1>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <div class="flex-row-reverse flex justify-between">
                    
                    <div class="pl-3 pb-5">
                        <label for="user">User</label>
                        <input type="radio" name="radAdmin" value="false" value="user" class="ml-1" checked="checked" onclick="hideChurchData()">
                        <label for="admin" class="pl-4">Church Admin</label>
                        <input type="radio" name="radAdmin" value="true" value="admin" class="ml-1" onclick="showChurchData()">
                    </div>
                    
                </div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            </br>
            <div class="grid grid-cols-2" id="church-form" style="display: none">
                <div class="mt-4">
                    <x-jet-label for="church_name" value="{{ __('Church Name') }}" />
                    <x-jet-input id="church_name" class="block mt-1 w-full" type="text" name="church_name" required="false" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="address" value="{{ __('Address') }}" />
                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" required="false"/>
                </div>
                <div class="mt-4">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <textarea id="description" class="block mt-1 w-full" name="description" required="false"></textarea>
                </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
<script>
    var churchForm = document.getElementById("church-form");
    function showChurchData() {
        churchForm.style.display = "block";
        document.getElementById("church_name").required = true;
        document.getElementById("address").required = true;
        document.getElementById("description").required= true;
    }
    function hideChurchData() {
        churchForm.style.display = "none";
        document.getElementById("church_name").required = false;
        document.getElementById("address").required = false;
        document.getElementById("description").required= false;
    }
</script>
