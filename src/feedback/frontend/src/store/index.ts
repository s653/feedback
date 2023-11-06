import { createStore } from "vuex";
import * as auth from './modules/auth.store'
import * as category from './modules/category.store'
import * as feedback from './modules/feedback.store'

export default createStore({
  state: {},
  getters: {},
  modules: {
    auth,
    category,
    feedback
  }
})
