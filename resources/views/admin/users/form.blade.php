<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="" enctype='multipart/form-data'>
        @csrf

        <!-- FName -->
            <div>
                <x-label for="fname" :value="__('First Name')"/>

                <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname',isset($userItem) ? $userItem->fname: '')" required
                         autofocus/>
            </div>

            <!-- LName -->
            <div class="mt-4">
                <x-label for="lname" :value="__('Last Name')"/>

                <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname',isset($userItem) ? $userItem->lname: '')" required
                         autofocus/>
            </div>

            <!-- ّPhone number-->
            <div class="mt-4">
                <x-label for="phone_number" :value="__('Phone Number')"/>

                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                         :value="old('phone_number',isset($userItem) ? $userItem->phone_number: '')" required autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email',isset($userItem) ? $userItem->email: '')" required/>
            </div>

            <!-- ّid Code-->
            <div class="mt-4">
                <x-label for="code" :value="__('National Code')"/>

                <x-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code',isset($userItem) ? $userItem->code: '')" required/>
            </div>

            <!-- ّDate Employment -->
            <div class="mt-4">
                <x-label for="date_employment" :value="__('Date Employment')"/>

                <div class="input-group">
                    <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                          </span>
                    </div>
                    <x-input id="date_employment" name="date_employment" :value="old('date_employment',isset($userItem) ? $userItem->date_employment: '')" class="normal-example form-control"/>
                </div>
            </div>

            <!-- ّBranch_work -->
            <div class="mt-4">
                <x-label for="branch_work" :value="__('Branch Working')"/>

                <x-input id="branch_work" class="block mt-1 w-full" type="text" name="branch_work"
                         :value="old('branch_work',isset($userItem) ? $userItem->branch_work: '')" required autofocus/>
            </div>

            <!-- ّ user_description -->
            <div class="mt-4">
                <x-label for="user_description" :value="__('Description')"/>

                <x-input id="user_description" class="block mt-1 w-full" type="text" name="user_description"
                         :value="old('user_description',isset($userItem) ? $userItem->user_description: '')" autofocus/>
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-label for="user_image" :value="__('Image')"/>
                <input type="file" name="user_image" class="form-control">
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('ذخیره اطلاعات') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
