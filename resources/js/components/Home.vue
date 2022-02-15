<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="w-50" style="text-align: end;margin:2px">
                    Blog Website
                </div>
                <span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                     viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>
                </span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse offset-md-8" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Nature</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">People</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1">Trips</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Animals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Fashion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Tech</a>
                        </li> |
                        <li class="nav-item" v-if="isLogged">
                            <a @click="logout" class="nav-link" href="#" tabindex="-1" aria-disabled="true">Logout</a>
                        </li>
                        <li class="nav-item" v-else>
                            <router-link to="/login" class="nav-link" href="#" tabindex="-1" aria-disabled="true">Login</router-link>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <br/>


        <div class="container">
            <div class="row">
                <div class="col-md-4" v-for="blog in blogs">
                    <div class="blog" style="position: relative;">
                        <img :src="'image/'+blog.image" alt="Lights" style="width: 100%; height: 280px;">
                        <span v-if="blog.category.name =='Nature'"
                              style="position:absolute;bottom: 100px;left: 0px;background:#58b600;color:white;padding: 10px;">Nature</span>
                        <span v-if="blog.category.name =='People'"
                              style="position:absolute;bottom: 100px;left: 0px;background:#1a54e7;color:white;padding: 10px;">People</span>
                        <span v-if="blog.category.name =='Tech'"
                              style="position:absolute;bottom: 100px;left: 0px;background:#000000;color:white;padding: 10px;">Tech</span>
                        <span v-if="blog.category.name =='Trips'"
                              style="position:absolute;bottom: 100px;left: 0px;background:#d90445;color:white;padding: 10px;">Trips</span>
                        <span v-if="blog.category.name =='Fashion'"
                              style="position:absolute;bottom: 100px;left: 0px;background:#8200b2;color:white;padding: 10px;">Fashion</span>

                        <div class="caption mt-1">
                            <h6 class="card-title">{{ blog.title }}</h6>
                            <p>{{blog.created_at | formatDate}} | <a href="">{{ blog.author.firstname }} {{ blog.author.lastname }}</a>
                            </p>
                        </div>
                        <div v-if="isLogged">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                <path
                                    d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Home",
    data() {
        return {
            isLogged: false,
            blogs: '',
        }
    },
    methods: {
        checkIfLogin() {
            axios.get('/api/check-login/').then((res) => {
                if (res.data.success === true) {
                    this.isLogged = true
                }
            }).catch((error) => {
                console.log(error)
            })
        },
        getAllBlogs() {
            axios.post('/api/get-all-blogs/').then((res) => {
                this.blogs = res.data
            }).catch((error) => {
                console.log(error)
            })
        },
        logout() {
            axios.get('/api/logout/').then(()=>{
                this.$router.push({name:'Home'})
            }).catch((error)=>{
                console.log(error)
            })
        }
    },
    created() {
        this.checkIfLogin()
        this.getAllBlogs()
    }
}
</script>
