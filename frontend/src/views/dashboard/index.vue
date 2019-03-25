<template>
  <div class="dashboard">

    <el-row :gutter="20" class="with-margin">
      <el-col :span="4">
        <el-input clearable placeholder="First name" v-model="query.firstName"></el-input>
      </el-col>

      <el-col :span="4">
        <el-input clearable placeholder="Last name" v-model="query.lastName"></el-input>
      </el-col>

      <el-col :span="4">
        <el-row type="flex" class="row-bg" justify="space-around">
          <el-button icon="el-icon-search" @click="onSearch">Search</el-button>
        </el-row>
      </el-col>
    </el-row>

    <el-row>
      <el-col>

        <data-table ref="dataTable" fetch-url="/user" :query="query">

          <!-- First Name -->
          <el-table-column prop="firstName">
          </el-table-column>

          <!-- Last Name -->
          <el-table-column prop="lastName">
          </el-table-column>

        </data-table>
      </el-col>
    </el-row>

  </div>
</template>

<script>

import Vue from 'vue'
import DataTable from '@/components/DataTable'

export default {
  components: { DataTable },
  data: function () {
    return {
      query: {
        firstName: '',
        lastName: ''
      }
    };
  },
  mounted() {
    Vue.nextTick(()=> {
      this.$refs.dataTable.fetchData();
    });
  },
  methods: {
    onSearch(){
      this.$refs.dataTable.fetchData().then(() => {
        // @todo handle end of request if needed
      });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .el-row.with-margin {
    margin-bottom: 20px;
  &:last-child {
     margin-bottom: 0;
   }
  }
</style>
