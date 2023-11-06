import axios from "axios"

export const state = {
  feedbacks: []
}

export const mutations = {
  setFeedbacks(state, feedbacks) {
    state.feedbacks = feedbacks
  }
}

export const getters = {
  feedbacks: state => state.feedbacks
}

export const actions = {
  async getFeedbacks({commit}) {
    const res = await axios.get('api/feedbacks');
    if(res.status === 200) {
      commit("setFeedbacks", res.data.data);
    }
    return res.data;
  },
  async createFeedback({commit}, data) {
    const res = await axios.post('api/feedbacks', data);
    if(res.status === 201) {
    }
    return res.data;
  }
}
