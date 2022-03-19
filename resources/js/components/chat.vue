<template xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="m-0 font-weight-bold text-primary">Inquiry Comments</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-lg">
                        <tbody>
                        <tr v-for="comment in comments.data">
                            <td class="col-3">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img :src="'/images/avatar.png'">
                                    </div>
                                    <p class="font-bold ms-3 mb-0">{{comment.user.name}}</p>
                                </div>
                            </td>
                            <td class="col-6" >
                                <p class=" mb-0">{{comment.comment}}</p> <small>{{comment.created_at | formatDate}}</small>
                            </td>

                        </tr>

                        </tbody>
                    </table>
                </div>
                <pagination :data="comments" @pagination-change-page="getComments">
                    <span slot="next-nav">&lt; Previous Comments</span>
                    <span slot="prev-nav">Next Comments &gt;</span>
                </pagination>
                <div class="card-footer">
                    <div class="message-form d-flex flex-direction-column align-items-center">
                        <a href="http://" class="black"><i data-feather="smile"></i></a>
                        <div class="d-flex flex-grow-1 ml-4">
                                <div class="col-md-10">
                                    <input type="text" class="form-control comment mb-2" placeholder="Type your Comment.... "v-model="comment" @keyup.enter ="addComment">
                                </div>
                                <div class="col-md-2 offset-0">
                                    <button class="btn btn-outline-info" @click="addComment" style="margin-left: 5px;">Send Comment</button>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name:'chats',
    props:['ticket','user'],
    data()
    {
        return{
            'comment':'',
            'comments':'',
        }
    },
    methods:{
        getComments(page=1)
        {
            axios.get('/getComments/'+this.ticket +'?page='+page).then(response => {
                this.comments = response.data.comments;
            });
        },

        addComment()
        {

            axios.post('/comment', {'comment':this.comment,'ticket':this.ticket}).then(response => {
            });
            this.getComments()
            this.comment =''
        }
    },

    mounted() {
        this.getComments();
    }

}
</script>
