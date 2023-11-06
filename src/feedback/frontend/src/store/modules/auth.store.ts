import axios from "axios"

import type { Profile } from '../../models/user.interface'

export const state = {
  user: {
    id: '',
    name: '',
    email: ''
  }
}

export const mutations = {
  setUser(state, user: Profile) {
    console.log("user ===> ",user);
    state.user = user;
  }
}

export const actions = {
  async login({commit}, creds: Profile) {
    const res = await axios.post('api/login', creds);
    console.log("res ==> ", res);
    if(res.status === 200) {
      commit('setUser', res.data.data.user)
      localStorage.setItem('TOKEN', res.data.data.token)
    }
    return res;
  },
  async logout({commit}) {
    const res = await axios.post('api/logout');
    if(res.status === 200) {
      localStorage.removeItem('TOKEN')
    }
    return res;
  }
}
