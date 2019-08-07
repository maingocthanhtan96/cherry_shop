const table = {
  namespaced: true,
  state: {
    loading: false,
  },
  getters: {
    // loading(state) {
    // 	return state.loading;
    // }
  },
  mutations: {
    'LOADING'(state, data) {
      // Do something
      state.loading = true;
    },
    'LOADED'(state, data) {
      state.loading = false;
    },
    'FILTER'(state, data) {
      // Do something
    },
    'SORTED'(state, data) {
      // Do something
    },
    'PAGINATE'(state, data) {

    },
    'LIMIT'(state, data) {
      // Do something
    },
    'ERROR'(state, data) {
      // Do something
    },
    'ROW_CLICK'(state, data) {
      // Do something
      console.log(data);
    },
    'SET_DATA'(state, data) {

    },
  },
  actions: {

  },
};
export default table;