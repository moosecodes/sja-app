<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import NavLink from '@/Components/NavLink.vue';

defineProps({
  clients: Array
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
        Clients
      </h2>
    </template>

    <div class="py-12 clients-list">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-4 gap-8">
          <div v-for="c in clients" :key="c.id">
                <div><b>{{c.firstName}} {{c.lastName}} <small>({{ getAge(c.dob) }})</small></b></div>
                <small>{{c.phone}}</small>
                <br />
                <small>Credits: {{ c.credits }}</small>
                <!-- <div class="my-4">
                    <PrimaryButton @click="addCredit(c.id)" class="mr-4">Add</PrimaryButton>
                    <PrimaryButton @click="removeCredit(c.id)">Remove</PrimaryButton>
                </div> -->
                <!-- <img
                    :src="c.profile_photo_url"
                    alt="c.profile_photo_url"
                    width="150"
                /> -->
                <!-- <div><b>Address</b> {{c.address1}} {{c.address2}}</div>
                <div><b>City</b> {{c.city}}</div>
                <div><b>State</b> {{c.state}}</div>
                <div><b>Zip</b> {{c.zip}}</div> -->
                <div>
                    <NavLink :href="route('client.edit', c.id)">
                        <b>Edit</b>
                    </NavLink>
                </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
