<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  clients: Array
})

const addCredit = (client_id) => {
  axios.put(`/api/credits/${client_id}/add`, { client_id })
}

const removeCredit = (client_id) => {
  axios.put(`/api/credits/${client_id}/remove`, { client_id })
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
        <div class="grid grid-cols-4 gap-4">
          <div v-for="c in clients" :key="c.id">
            <img
                :src="c.profile_photo_url"
                alt="c.profile_photo_url"
                width="150"
            >
            <div>
              <div>Credits: {{ c.credits }}</div>
              <div>
                <button @click="addCredit(c.id)">Add</button>
                <button @click="removeCredit(c.id)">Remove</button>
              </div>
            </div>
            <div>{{c.firstName}} {{c.lastName}}</div>
            <div><b>DOB</b> {{c.dob}}</div>
            <div><b>Phone</b> {{c.phone}}</div>
            <div><b>Address</b> {{c.address1}} {{c.address2}}</div>
            <div><b>City</b> {{c.city}}</div>
            <div><b>State</b> {{c.state}}</div>
            <div><b>Zip</b> {{c.zip}}</div>
          </div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>
