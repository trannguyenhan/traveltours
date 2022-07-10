import isEqual from '../ultils/isEqual';

export function multipleSelection(field) {
  return {
    methods: {
      setSelection() {
        this.selection = [...this.$route.query[field]]; // The route object is immutable
      },
      hasSelectionValue() {
        return this.selection && this.selection.length > 0;
      },
    },
  };
}

function hasSelectionValue() {
  return !!this.selection;
}

export function singleStringSelection(field) {
  return {
    methods: {
      setSelection() {
        this.selection = this.$route.query[field];
      },

      hasSelectionValue,
    },
  };
}
export function singleNumberSelection(field) {
  return {
    methods: {
      setSelection() {
        this.selection = +this.$route.query[field];
      },

      hasSelectionValue,
    },
  };
}

// if selection is equal to the default, we clear it on the URL

// need to put in last to override method hasSelectionValue()
export function defaultSelection(field) {
  return {
    methods: {
      isSynced() {
        return (
          isEqual(this.selection, this.$route.query[field]) ||
          (!this.hasSelectionValue() && !this.$route.query[field])
        );
      },

      hasSelectionValue() {
        return !isEqual(this.selection, this.defaultSelection);
      },

      clearSelection() {
        if (this.hasSelectionValue()) this.selection = this.defaultSelection;
      },
    },
  };
}
