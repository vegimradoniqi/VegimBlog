<template>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <side-menu></side-menu>
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Blog Registration Form</h3>
                        <div>
                            <b-form @submit="onSubmit" id="createBlog" @reset="onReset" v-if="show">
                                <b-form-group
                                    id="input-group-1"
                                    label="Blog Title:"
                                    label-for="input-1"
                                >
                                    <b-form-input
                                        id="input-1"
                                        v-model="form.title"
                                        type="text"
                                        placeholder="Enter Blog Title"
                                        required
                                    ></b-form-input>
                                </b-form-group>

                                <b-form-group id="input-group-3" label="Category:" label-for="input-3">
                                    <b-form-select
                                        id="input-3"
                                        v-model="form.category"
                                        :options="categories"
                                        required
                                    ></b-form-select>
                                </b-form-group>
                                <br>
                                <b-form-group id="input-group-3" label="Select Photo:" label-for="input-3">
                                    <b-form-file v-model="form.image" class="mt-3" @change="handleOnchange" required
                                                 plain></b-form-file>
                                </b-form-group>
                                <br>
                                <b-form-group id="input-group-4" label="Text:" label-for="input-4">
                                    <b-form-textarea
                                        id="textarea"
                                        v-model="form.description"
                                        placeholder="Enter something..."
                                        rows="3"
                                        max-rows="6"
                                    ></b-form-textarea>
                                </b-form-group>
                                <br>


                                <b-button type="submit" variant="primary">Submit</b-button>
                                <b-button type="reset" variant="danger">Reset</b-button>
                            </b-form>
                        </div>
                        <hr>
                        <div v-if="restore">
                            <b-card no-body class="text-center">
                                <div class="bg-danger text-light">
                                    {{message}}
                                    <div class="d-inline p-2" @click="restoreBlog(restore_id)"><i class="bi bi-arrow-clockwise"></i>UNDO</div>
                                </div>
                            </b-card>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table">
                                    <caption>List of blogs</caption>
                                    <thead>
                                    <tr>
                                        <th scope="col">Blog title</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="blog in blogs">
                                        <td>{{blog.title}}</td>
                                        <td>{{blog.author.username}}</td>
                                        <td>{{blog.category.name}}</td>
                                        <td>

                                            <div class="d-inline p-2"><i class="bi bi-pencil-square" :id="blog.id"></i></div>
                                            <div class="d-inline p-2"><i class="bi bi-trash3" :id="blog.id" @click="deleteBlog(blog.id)"></i></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import SideMenu from "../Layouts/SideMenu";
import $ from 'jQuery'

export default {
    components: {SideMenu},
    data() {
        return {
            blogs: '',
            form: {
                title: '',
                description: '',
                image: null,
                category: null,

            },
            categories: [],
            show: true,
            restore: false,
            restore_id: '',
            message: ''
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            const formData = new FormData()
            formData.append('image', this.form.image)
            formData.append('title', this.form.title)
            formData.append('description', this.form.description)
            formData.append('category', this.form.category)
            formData.append('type', 'storeBlog')
            axios.post('/api/blog-handle/', formData).then((response) => {
                this.restore = false
                this.restore_id = ''
                this.message = ''
                this.getBlogs()
                this.clearForm()
            })

        },
        handleOnchange(e) {
            this.form.image = e.target.files[0]
        },
        onReset(event) {
            event.preventDefault()
            // Reset our form values
            this.clearForm()
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        },
        clearForm(){
            this.form.title = ''
            this.form.image = ''
            this.form.category = null
            this.form.description = null
        },
        getCategories() {
            axios.post('/api/blog-handle/',{type:'getCategories'}).then((res) => {
                let list = [{text: 'Select One', value: null}];
                $.each(res.data.categories, function (key, val) {
                    list.push({text: val.name, value: val.id})
                })
                this.categories = list

            }).catch((error) => {
                console.log(error)
            })
        },
        getBlogs() {
            axios.post('/api/blog-handle/',{type:'getBlogs'}).then((res) => {
                this.blogs = res.data
            }).catch((error) => {
                console.log(error)
            })
        },
        deleteBlog(id){
            axios.post('/api/blog-handle/', {id:id, type:'deleteBlog'}).then((res) => {
                if (res.data.success === true){
                    this.restore = true
                    this.restore_id = res.data.blog_id
                    this.message = res.data.message
                }
                this.getBlogs()
            }).catch((error) => {
                console.log(error)
            })
        },
        restoreBlog(id){
            axios.post('/api/blog-handle/', {id:id, type:'restoreBlog'}).then((res) => {
                if (res.data.success === true){
                    this.restore = false
                    this.restore_id = ''
                    this.message = ''
                }
                this.getBlogs()
            }).catch((error) => {
                console.log(error)
            })
        }
    },
    mounted() {
        this.getCategories()
        this.getBlogs()
    }
}
</script>
