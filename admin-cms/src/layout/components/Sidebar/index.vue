<template>
  <div :class="{ 'has-logo': showLogo }">
    <div>{{ roles }}</div>
    <logo v-if="showLogo" :collapse="isCollapse" />
    <el-scrollbar wrap-class="scrollbar-wrapper">
      <el-menu
        :default-active="activeMenu"
        :collapse="isCollapse"
        :background-color="variables.menuBg"
        :text-color="variables.menuText"
        :unique-opened="false"
        :active-text-color="variables.menuActiveText"
        :collapse-transition="false"
        mode="vertical"
      >
        <sidebar-item
          v-for="route in routes"
          :key="route.path"
          :item="route"
          :base-path="route.path"
        />
      </el-menu>
    </el-scrollbar>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import Logo from "./Logo";
import SidebarItem from "./SidebarItem";
import variables from "@/styles/variables.scss";

export default {
  components: { SidebarItem, Logo },
  computed: {
    ...mapGetters(["sidebar", "roles"]),
    routes() {
      let listRoutes = this.$router.options.routes;
      console.log(listRoutes);
      if (this.filterAdminSeller(this.roles) == "admin") {
        return [listRoutes[0], listRoutes[1], listRoutes[6], listRoutes[8]];
      }
      if (this.filterAdminSeller(this.roles) == "seller") {
        return [
          listRoutes[0],
          listRoutes[1],
          listRoutes[2],
          listRoutes[3],
          listRoutes[4],
          listRoutes[6],
        ];
      }
    },
    activeMenu() {
      const route = this.$route;
      const { meta, path } = route;
      // if set path, the sidebar will highlight the path you set
      if (meta.activeMenu) {
        return meta.activeMenu;
      }
      return path;
    },
    showLogo() {
      return this.$store.state.settings.sidebarLogo;
    },
    variables() {
      return variables;
    },
    isCollapse() {
      return !this.sidebar.opened;
    },
  },
  methods: {
    filterAdminSeller(listRoles) {
      let roles = [];
      for (let i = 0; i < listRoles.length; i++) {
        roles.push(listRoles[i].pivot.role_id);
      }
      if (roles.includes(1)) return "admin";
      if (roles.includes(3)) return "seller";
    },
  },
};
</script>
<style>
a {
  text-decoration: none;
}
</style>
