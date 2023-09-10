<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    dob: '',
    firstName: '',
    lastName: '',
    phone: '',
    address1: '',
    address2: '',
    city: '',
    state: '',
    zip: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">
          <div class="mt-4">
            <InputLabel for="dob" value="Date of Birth" />
            <TextInput
                id="dob"
                v-model="form.dob"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="dob"
            />
            <InputError class="mt-2" :message="form.errors.dob" />
          </div>

          <div class="mt-4">
            <InputLabel for="firstName" value="First Name" />
            <TextInput
                id="firstName"
                v-model="form.firstName"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="firstName"
            />
            <InputError class="mt-2" :message="form.errors.firstName" />
          </div>

          <div class="mt-4">
            <InputLabel for="lastName" value="Last Name" />
            <TextInput
                id="lastName"
                v-model="form.lastName"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="lastName"
            />
            <InputError class="mt-2" :message="form.errors.lastName" />
          </div>

          <div class="mt-4">
            <InputLabel for="phone" value="Phone" />
            <TextInput
                id="phone"
                v-model="form.phone"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="phone"
            />
            <InputError class="mt-2" :message="form.errors.phone" />
          </div>

          <div class="mt-4">
            <InputLabel for="address1" value="Address 1" />
            <TextInput
                id="address1"
                v-model="form.address1"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="address1"
            />
            <InputError class="mt-2" :message="form.errors.address1" />
          </div>

          <div class="mt-4">
            <InputLabel for="address2" value="Address 2" />
            <TextInput
                id="address2"
                v-model="form.address2"
                type="text"
                class="mt-1 block w-full"
                autofocus
                autocomplete="address2"
            />
            <InputError class="mt-2" :message="form.errors.address2" />
          </div>

          <div class="mt-4">
            <InputLabel for="city" value="City" />
            <TextInput
                id="city"
                v-model="form.city"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="city"
            />
            <InputError class="mt-2" :message="form.errors.city" />
          </div>

          <div class="mt-4">
            <InputLabel for="state" value="State" />
            <TextInput
                id="state"
                v-model="form.state"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="state"
            />
            <InputError class="mt-2" :message="form.errors.state" />
          </div>

          <div class="mt-4">
            <InputLabel for="zip" value="Zip" />
            <TextInput
                id="zip"
                v-model="form.zip"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="zip"
            />
            <InputError class="mt-2" :message="form.errors.zip" />
          </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
