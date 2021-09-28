<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <!-- datepicker  -->
      <div class="card mt-5">
        <div class="card-header">Find Doctors</div>

        <div class="card-body">
          <datepicker
            class="datepicker-size"
            calendar-class="datepicker-size_calendar"
            :format="customDate"
            v-model="date"
            :disabledDates="disabledDates"
            :inline="true"
          ></datepicker>
        </div>
      </div>

      <!-- display doctors  -->
      <div class="card mt-4">
        <div class="card-header">Find Doctors</div>

        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col" style="width: 20%">#</th>
                <th scope="col" style="width: 20%">Picture</th>
                <th scope="col" style="width: 20%">Name</th>
                <th scope="col" style="width: 20m">Expertise</th>
                <th scope="col" style="width: 20%">Book</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(appointment, key) in appointments" :key="key">
                <th scope="row">{{ key + 1 }}</th>
                <td>
                  <div v-if="appointment.doctor_picture">
                    <img
                      class="cirle-image"
                      :src="'/storage/' + appointment.doctor_picture"
                      alt=""
                    />
                  </div>
                  <div v-else>
                    <img
                      class="cirle-image"
                      :src="'/images/doctor-avatar.svg'"
                      alt=""
                    />
                  </div>
                </td>
                <td>{{ appointment.doctor_name }}</td>
                <td>{{ appointment.doctor_department }}</td>
                <td>
                  <button
                    class="btn btn-success btn-block"
                    @click="
                      bookAppointment(appointment.user_id, appointment.date)
                    "
                  >
                    Book Appointment
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="text-center">
            <div v-if="appointments.length === 0 && !loading">
              No Doctor available for :
              {{ date }}
            </div>
            <pulse-loader :loading="loading"></pulse-loader>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import datepicker from "vuejs-datepicker";
import moment from "moment";
import axios from "axios";
import PulseLoader from "vue-spinner/src/PulseLoader.vue";
export default {
  mounted() {
    this.date = new Date().toISOString().slice(0, 10);

    this.loading = true;
    axios.get("api/doctors/today").then((response) => {
      this.appointments = response.data.data;
      this.loading = false;
    });
  },
  components: {
    datepicker,
    PulseLoader,
  },
  data() {
    return {
      date: "",
      appointments: [],
      loading: false,
      disabledDates: {
        to: new Date(Date.now() - 86400000),
      },
    };
  },
  methods: {
    customDate(date) {
      this.loading = true;
      this.date = moment(date).format("YYYY-MM-DD");
      axios
        .post("/api/doctors/find", {
          date: this.date,
        })
        .then((response) => {
          setTimeout(() => {
            this.appointments = response.data.data;
            this.loading = false;
          }, 2000);
        })
        .catch((error) => {
          alert(error);
        });
    },
    bookAppointment($doctorId, $date) {
      window.location.href = "/new-appointment/" + $doctorId + "/" + $date;
    },
  },
};
</script>
<style scoped>
.datepicker-size >>> .datepicker-size_calendar {
  width: 100%;
  height: 340px;
}
.cirle-image {
  border-radius: 50%;
  border: 3px solid #38c172;
  width: 50px;
  height: 50px;
  object-fit: cover;
}
</style>
