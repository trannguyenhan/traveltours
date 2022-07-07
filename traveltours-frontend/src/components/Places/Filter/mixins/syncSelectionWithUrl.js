import isEqual from '../ultils/isEqual';

export default function (field) {
  return {
    data: () => ({
      selection: undefined,
    }),

    watch: {
      selection: 'syncSelectionToUrl',

      // Watch the route changed when using Back/Foward in browser
      $route: {
        handler: 'syncUrlToSelection',
        immediate: true, // run that above function in the create hook
      },
    },

    methods: {
      syncSelectionToUrl() {
        // avoid deadlock after set selection based on URL
        if (this.isSynced()) return;

        const { page, ...routeQueryClone } = { ...this.$route.query };
        // const filterQuery = this.setFilterQuery(routeQueryClone);

        if (this.hasSelectionValue()) {
          routeQueryClone[field] = this.selection;
        } else {
          // clean URL query when clean Selection
          delete routeQueryClone[field];
        }

        this.$router.push({ path: 'tours', query: routeQueryClone });
        // .catch(() => {});
      },

      isSynced() {
        return isEqual(this.selection, this.$route.query[field]);
      },

      syncUrlToSelection() {
        // avoid deadlock after set URL based on selection
        if (this.isSynced()) return;

        if (!this.$route.query[field]) {
          this.clearSelection();
        } else this.setSelection();
      },

      clearSelection() {
        // clear selection when use back/foward in browser
        // to another Url not contains this field
        // but selection still have value
        if (this.selection) this.selection = undefined;
      },
    },
  };
}
