import axios from "axios"

export const state = {
  feedbacks: []
}

export const mutations = {
  setFeedbacks(state, feedbacks) {
    state.feedbacks = feedbacks
  },
  updateVoteStatus(state, feedbackId) {
    // Find index of the item to be updated
    const itemIndex = state.feedbacks.findIndex(x => x.id === feedbackId)
    if(state.feedbacks[itemIndex].isVoted) {
      state.feedbacks[itemIndex].total_votes = state.feedbacks[itemIndex].total_votes - 1;
    } else {
      state.feedbacks[itemIndex].total_votes = state.feedbacks[itemIndex].total_votes + 1;
    }
    state.feedbacks[itemIndex].isVoted = !state.feedbacks[itemIndex].isVoted
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
    if(res.status === 401) {
      window.location.href = 'http://feedback.local.com/login'
    }
    return res.data;
  },
  async createFeedback({commit}, data) {
    const res = await axios.post('api/feedbacks', data);
    if(res.status === 201) {
    }
    return res;
  },
  async voteFeedback({commit}, feedbackId: any) {
    commit('updateVoteStatus', feedbackId)
    const res = await axios.post('api/votes', {feedback_id: feedbackId});
    if(res.status === 201) {
      console.log("vote created ==> ", res.data)
    } else {
      console.log("vote deleted ==> ", res.data)
    }
    return res;
  }
}
