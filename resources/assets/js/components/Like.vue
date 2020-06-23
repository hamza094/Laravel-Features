<template>
    <button type="submit" :class="classes" class="pull-right" @click="toggle">
    <span class="glyphicon glyphicon-heart"></span>
    <span v-text="likesCount"></span>
    </button>   
</template>
<script>
    export default {
        props: ['comment'],
        data() {
            return {
                likesCount: this.comment.LikesCount,
                isLiked: this.comment.isLiked
            }
        },

        computed: {
            classes() {
                return ['btn', this.isLiked ? 'btn-primary' : 'btn-secondary'];
            }
        },

        methods: {
            toggle() {

                return this.isLiked ? this.destroy() : this.create();

            },

            create() {
                axios.get('/comment/like/' + this.comment.id);
                this.isLiked = true;
                this.likesCount++;
                iziToast.success({
                    title: 'Liked',
                });
            },
            destroy() {
                axios.get('/comment/unlike/' + this.comment.id);
                this.isLiked = false;
                this.likesCount--;
                iziToast.info({
                    title: 'Unliked',
                });
            }


        }
    }
</script>