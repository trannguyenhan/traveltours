import { mapActions, mapGetters } from 'vuex';
import { FETCH_TOURS } from '@/store/type/actions.js';

import { multipleSelection } from './selection';

export default function (field, fetchFieldAction) {
  return {
    mixins: [multipleSelection(field)],
    data: () => ({
      isOptionListLoading: false,
    }),

    computed: {
      ...mapGetters([field]),
    },

    methods: {
      ...mapActions([FETCH_TOURS, fetchFieldAction]),

      async getOptionList() {
        if (!this[field].length) {
          this.isOptionListLoading = true;
          await this[fetchFieldAction]();
          this.isOptionListLoading = false;
        }
      },

      removeFilterItem(removedItem, array) {
        for (let i = 0; i < array.length; i += 1) {
          // eslint-disable-next-line security/detect-object-injection
          if (array[i] === removedItem) {
            array.splice(i, 1);
          }
        }
      },

      setSelection() {
        this.getOptionList().then(() => {
          multipleSelection(field).methods.setSelection.call(this);
        });
      },
    },
  };
}
