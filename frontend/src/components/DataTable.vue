<template>
    <div>
        <el-table
                :data="list"
                border
        >
            <slot></slot>
        </el-table>

        <span class="separator"></span>

        <div class="pagination-container">
            <el-pagination
                    :current-page="params.pagination.current"
                    :page-size="params.pagination.numItemsPerPage"
                    :total="params.pagination.totalCount"
                    layout="prev, pager, next"
                    @current-change="onPageChange"
            />
        </div>
    </div>
</template>

<script>

    import request from '@/common/request';

    export default {
        props: ['fetchUrl', 'query'],
        name: "DataTable",
        data: function () {
            return {
                list: null,
                listLoading: true,
                params: {
                    pagination: {
                        current: 1,
                        numItemsPerPage: 10,
                    },
                    sort: '',
                    direction: '',
                    query: ''
                },
            }
        },
        methods: {
            fetchData() {
                this.listLoading = true;
                this.list = [];

                const params = {
                    page: this.params.pagination.current || 1,
                    perPage: this.params.pagination.numItemsPerPage,
                    sort: this.params.sort,
                    direction: this.params.direction
                };

                if (this.query){
                    _.forEach(this.query, (item, key)=>{
                        params[key] = item;
                    });
                }

                return request.get(this.fetchUrl, { params: params } ).then(response => {
                    if(response.data) {
                        this.list = response.data.data;console.log(this.list);
                        // this.params.pagination = response.pagination;
                    }
                    this.listLoading = false
                })
            },
            onPageChange(page) {
                this.params.pagination.current = page;
                this.fetchData()
            }
        }
    }
</script>

<style scoped>
</style>
