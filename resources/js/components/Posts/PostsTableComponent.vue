<template>
<div>
    <preloader :done="done"></preloader>
    <div v-if="done">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created</th>
                    <th scope="col" class="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts.posts">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.created_at }}</td>
                    <td>
                        <a :href="'/posts/' + post.id">View</a>
                        <a :href="'/admin/posts/edit/' + post.id">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
    import axios from 'axios'
    import preloader from '../Shared/preloader.vue'

    export default {
        mounted () {
            console.log('Component PostsTableComponent mounted.')
        },
        components: {
            preloader
        },
        data () {
            return {
                done: false,
                posts: {
                    posts: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/posts.json')
            .then(response => {
                this.posts = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>
