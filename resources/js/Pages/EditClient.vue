<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import NavLink from '@/Components/NavLink.vue';

defineProps({
  client: Array
})

const addCredit = (client_id) => {
  axios.put(`/api/credits/${client_id}/add`, { client_id })
}

const removeCredit = (client_id) => {
  axios.put(`/api/credits/${client_id}/remove`, { client_id })
}

function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}
</script>

<template>
  <AppLayout title="Clients">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Client
      </h2>
    </template>

    <div class="py-12 clients-list">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
            <div><b>{{client.firstName}} {{client.lastName}} <small>({{ getAge(client.dob) }})</small></b></div>
            <small>{{client.phone}}</small>
            <br />
            <img
                :src="client.profile_photo_url"
                alt="client.profile_photo_url"
                width="150"
            />
            <small>Credits: {{ client.credits }}</small>
            <div class="my-4">
                <PrimaryButton @click="addCredit(client.id)" class="mr-4">Add</PrimaryButton>
                <PrimaryButton @click="removeCredit(client.id)">Remove</PrimaryButton>
            </div>
            <div><b>Address</b> {{client.address1}} {{client.address2}}</div>
            <div><b>City</b> {{client.city}}</div>
            <div><b>State</b> {{client.state}}</div>
            <div><b>Zip</b> {{client.zip}}</div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
