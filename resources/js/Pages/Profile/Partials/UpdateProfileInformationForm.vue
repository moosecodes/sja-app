<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    firstName: props.user.firstName,
    lastName: props.user.lastName,
    email: props.user.email,
    dob: props.user.dob,
    address1: props.user.address1,
    address2: props.user.address2,
    city: props.user.city,
    state: props.user.state,
    zip: props.user.zip,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.firstName" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="firstName" value="First Name" />
                <TextInput
                    id="firstName"
                    v-model="form.firstName"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="firstName"
                />
                <InputError :message="form.errors.firstName" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="lastName" value="Last Name" />
              <TextInput
                  id="lastName"
                  v-model="form.lastName"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autocomplete="lastName"
              />
              <InputError :message="form.errors.lastName" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="dob" value="Date of Birth" />
              <TextInput
                  id="dob"
                  v-model="form.dob"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autocomplete="dob"
              />
              <InputError :message="form.errors.dob" class="mt-2" />
            </div>

          <div class="col-span-6 sm:col-span-4">
            <InputLabel for="phone" value="Phone" />
            <TextInput
                id="phone"
                v-model="form.phone"
                type="text"
                class="mt-1 block w-full"
                required
                autocomplete="phone"
            />
            <InputError :message="form.errors.phone" class="mt-2" />
          </div>

            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="address1" value="Address 1" />
              <TextInput
                  id="address1"
                  v-model="form.address1"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autocomplete="address1"
              />
              <InputError :message="form.errors.address1" class="mt-2" />
            </div>


            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="address2" value="Address 2" />
              <TextInput
                  id="address2"
                  v-model="form.address2"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autocomplete="address2"
              />
              <InputError :message="form.errors.address2" class="mt-2" />
            </div>


            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="city" value="City" />
              <TextInput
                  id="city"
                  v-model="form.city"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autocomplete="city"
              />
              <InputError :message="form.errors.city" class="mt-2" />
            </div>


            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="state" value="State" />
              <TextInput
                  id="state"
                  v-model="form.state"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autocomplete="state"
              />
              <InputError :message="form.errors.state" class="mt-2" />
            </div>


            <div class="col-span-6 sm:col-span-4">
              <InputLabel for="zip" value="Zip" />
              <TextInput
                  id="zip"
                  v-model="form.zip"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autocomplete="zip"
              />
              <InputError :message="form.errors.zip" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        Your email address is unverified.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            @click.prevent="sendEmailVerification"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        A new verification link has been sent to your email address.
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
