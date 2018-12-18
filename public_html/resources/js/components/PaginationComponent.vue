<template>
    <div>
        <table width="90%" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
            <tr>
                <th width="1%">#</th>
                <th>Título</th>
                <th>Matéria</th>
                <th>Feed</th>
            </tr>
            </thead>
            <tbody>
                    <tr v-for="item in newsData.data" :key="user.id">
                        <td>{{ item.id }}</td>
                        <td><a :href="item.id">{{ item.title }}</a></td>
                        <td>{{ item.description }}</td>
                        <td>{{item.categoria.descricao}}</td>
                    </tr>
            </tbody>
        </table>

        <div class="row text-center">
            <pagination :data="newsData" @pagination-change-page="getResults" :show-disabled="true"></pagination>
        </div>


    </div>
</template>

<script>
    export default {

        data() {
            return {
                // Our data object that holds the Laravel paginator data
                newsData: {},
            }
        },

        mounted() {
            // Fetch initial results
            this.getResults();
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('/api/getNews?page=' + page)
                    .then(response => {
                        this.newsData = response.data;
                    });
            }
        }

    }
</script>
