<template>
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Verifying Email</h2>
                                <div class="d-flex justify-content-center" v-if="message !== ''">{{ message }}</div>
                                <div class="d-flex justify-content-center">
                                    <router-link to="/Login"
                                                 class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">
                                        Login
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "VerifyEmail",
    data() {
        return {
            message: ""
        }
    },
    beforeRouteEnter(to, from, next) {
        let uri = window.location.search.substring(1);
        let params = new URLSearchParams(uri);
        let id = params.get("id");
        let hash = params.get("hash")
        axios.get('/api/email-verification/?id=' + id + '&hash=' + hash).then((response) => {
            to.params.message = "response.data.message"
            next()
        }).catch(function (error) {
            console.log(error);
        });
    }
}
</script>
