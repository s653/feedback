<template>
  <header class="inverted">
    <h2 class="text-center">Feedback</h2>
  </header>
  <form class="row g-3" @submit.prevent="onSubmit">
      <div class="col-md-12">
        <label for="inputEmail4" class="form-label">Title</label>
        <input type="text" class="form-control" id="inputEmail4" v-model="form.title">
      </div>
      <div class="col-md-12">
        <label for="inputCategory4" class="form-label">Category</label>
        <select class="form-control" v-model="form.category_id">
          <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
        </select>
      </div>
      <div class="col-md-12">
        <label for="inputPassword4" class="form-label">Description</label>
        <div id="app" style="padding: 0px;">
          <ckeditor :editor="editor" v-model="editorData" @ready="onReady" @input="onChange"></ckeditor>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="w-100 mt-2 submit" :disabled="loading">Submit</button>
      </div>
    </form>
</template>
<script lang="ts">
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
  import CKEditor from "@ckeditor/ckeditor5-vue"
  import { computed, onBeforeMount, ref } from "@vue/runtime-core";
  import { useStore } from "vuex";

  export default {
    name: 'create',
    components: {
      ckeditor: CKEditor.component
    },
    setup() {

      const store = useStore();

      console.log("store ==> ", store)

      const form = ref({
        title: '',
        description: '',
        category_id: ''
      })
      const loading = ref(false)
      const editor = ref(ClassicEditor)
      const editorData = ref("<p>Hello from solo individual!</p>")

      onBeforeMount(() => {
        store.dispatch("getCategories");
      })

      const onSubmit = () => {
        loading.value = true
        store.dispatch("createFeedback", form.value).then(res => {
          if(res.status === 201) {
            loading.value = false
          }
        })
      }
      const onReady = ( editor: any ) => {
        console.log( "CKEditor5 Vue Component is ready to use!", editor );
      }
      const onChange = ( data: any ) => {
        form.value.description = data;
        console.log( data );
      }

      return {
        categories: computed(() => store.getters.categories),
        form,
        loading,
        editor,
        editorData,
        onSubmit,
        onReady,
        onChange
      }
    }
  }
</script>
