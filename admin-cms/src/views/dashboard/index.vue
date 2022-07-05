<template>
  <div class="dashboard-container">
    <div class="dashboard-text">ADMIN Travel Tour</div>
    <br>
    <div class="cards">
      <div class="card">
        <div class="icon">
          <i class="fa fa-users" />
        </div>
        <div class="num">{{ countTour }}</div>
        <h3>Tours</h3>
      </div>
      <div class="card">
        <div class="icon">
          <i class="fa fa-copy" />
        </div>
        <div class="num">{{ countPlace }}</div>
        <h3>Places</h3>
      </div>
      <div class="card">
        <div class="icon">
          <i class="fa fa-shopping-bag" />
        </div>
        <div class="num">{{ countUser }}</div>
        <h3>Users</h3>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { getListPlace } from '@/api/place'
import { getListTour } from '@/api/tour'
import { getListUser } from '@/api/user'

export default {
  name: 'Dashboard',
  computed: {
    ...mapGetters([
      'name'
    ])
  },
  data() {
    return {
      countPlace: 0,
      countTour: 0,
      countUser: 0
    }
  },
  mounted() {
    this.getListPlace()
    this.getListTour()
    this.getListUser()
  },
  methods: {
    getListPlace() {
      getListPlace().then(response => {
        this.countPlace = response.data.length
      })
    },
    getListTour() {
      getListTour().then(response => {
        this.countTour = response.data.length
      })
    },

    getListUser() {
      getListUser().then(response => {
        this.countUser = response.data.length
      })
    }
  }
}
</script>
<style lang="scss" scoped>
.dashboard {
  &-container {
    margin: 30px;
  }
  &-text {
    font-size: 30px;
    line-height: 46px;
  }
}

.cards{
  flex: 1 1 34%;
  flex-wrap: wrap;
}
.card{
  border-radius: 6px;
  border: 1px solid #deebfd;
  box-shadow: 0 3px 10px rgba(62,85,120,.045);
  margin: 0 8px 10px;
  position: relative;
  background-color: #5CAD8A;
  height: 120px;
  padding: 20px;
}
.card .icon {
  color: rgba(0, 0, 0, 0.1);
  position: absolute;
  right: 38px;
  bottom: 69px;
  z-index: 1;
}
.card .icon i {
  font-size: 100px;
  line-height: 0;
  margin: 0;
  padding: 0;
  vertical-align: bottom;
}
.card .num, .card h3{
  position: relative;
  color: #fff;
  z-index: 5;
  margin: 0;
  padding: 0;
}
.card .num {
  font-size: 50px;
  font-weight: bold;
}
.card h3{
  font-size: 20px;
  margin-left: 5px;
}
@media only screen and (max-width: 768px) {
  .cards{
    flex: 1 1 100%;
  }
  .card .icon {
    z-index: 0;
  }
  .card .num, .card h3 {
    z-index: 0;
  }
}
</style>
