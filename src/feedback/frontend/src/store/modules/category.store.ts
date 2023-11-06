import axios from "axios"

export const state = {
  categories: []
}

export const mutations = {
  setCategories(state, categories) {
    state.categories = categories;
  }
}

export const getters = {
  categories: state => state.categories
}

export const actions = {
  async getCategories({commit}) {
    const res = await axios.get('api/categories');
    if(res.status === 200) {
      commit('setCategories', res.data.data)
    }
    return res.data;
  }
}
