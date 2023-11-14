<template>
  <section class="container d-flex justify-content-center align-items-center" style="height: 70vh; max-height: 100vh;">
  <div class="col-md-8">
  <header class="inverted my-5">
    <h2 class="text-center">Report Query</h2>
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
          <ckeditor :editor="editor" v-model="form.description" @ready="onReady" @input="onChange"></ckeditor>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="w-100 mt-2 submit" :disabled="loading">Submit</button>
      </div>
    </form>
    </div>
  </section>
</template>
<script lang="ts">
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
  import CKEditor from "@ckeditor/ckeditor5-vue"
  import { computed, onBeforeMount, ref } from "@vue/runtime-core";
  import { useStore } from "vuex";
  import { useRouter } from "vue-router";

  export default {
    name: 'create',
    components: {
      ckeditor: CKEditor.component
    },
    setup() {

      const store = useStore();
      const router = useRouter();

      const form = ref({
        title: '',
        description: '<p>Hello from solo individual!</p>',
        category_id: ''
      })
      const loading = ref(false)
      const editor = ref(ClassicEditor)

      onBeforeMount(() => {
        store.dispatch("getCategories");
      })

      const onSubmit = () => {
        loading.value = true
        store.dispatch("createFeedback", form.value).then((res:any) => {
          loading.value = false
          if(res.status === 201) {
            router.push('/')
          }
        })
      }
      const onReady = ( editor: any ) => {
        console.log( "CKEditor5 Vue Component is ready to use!", editor );
      }
      const onChange = ( data: any ) => {
        console.log( data );
      }

      return {
        categories: computed(() => store.getters.categories),
        form,
        loading,
        editor,
        onSubmit,
        onReady,
        onChange
      }
    }
  }
</script>
