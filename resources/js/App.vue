<template>
    <el-row :gutter="20">
        <el-col :xs="{span: 24}" :sm="{span: 3}" :md="{span: 6}"></el-col>
        <el-col :xs="{span: 24}" :sm="{span: 18}" :md="{span: 12}">
            <search-form></search-form>
        </el-col>
        <el-col :xs="{span: 24}" :sm="{span: 3}" :md="{span: 6}"></el-col>
    </el-row>
</template>

<script>
import SearchForm from "./components/SearchForm.vue";

export default {
    name: "App",
    components: {SearchForm},
}
</script>

<style>

</style>
