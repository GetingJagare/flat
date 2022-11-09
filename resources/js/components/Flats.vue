<template>
    <el-alert title="No Results found" type="info" v-if="!list.length && found" style="margin-top: 20px;"/>
    <el-row style="padding-top: 20px;" :gutter="20" v-else-if="found">
        <el-col :span="24">
            <h2>Results: {{ list.length }}</h2>
        </el-col>
        <el-col v-for="f in list" :xs="{span: 24}" :sm="{span: 12}" :lg="{span: 8}">
            <el-card style="margin-bottom: 20px;">
                <h3 style="margin-top: 0;">{{ f.name }}</h3>
                <el-row align="middle" style="margin-bottom: 10px;">
                    <span><b>Price:</b></span>&nbsp;<span>{{ f.price }}</span>
                </el-row>
                <el-row align="middle" style="margin-bottom: 10px;">
                    <span><b>Bedrooms:</b></span>&nbsp;<span>{{ f.bedrooms }}</span>
                </el-row>
                <el-row align="middle" style="margin-bottom: 10px;">
                    <span><b>Bathrooms:</b></span>&nbsp;<span>{{ f.bathrooms }}</span>
                </el-row>
                <el-row align="middle" style="margin-bottom: 10px;">
                    <span><b>Storeys:</b></span>&nbsp;<span>{{ f.storeys }}</span>
                </el-row>
                <el-row align="middle">
                    <span><b>Garages:</b></span>&nbsp;<span>{{ f.garages }}</span>
                </el-row>
            </el-card>
        </el-col>
    </el-row>
</template>

<script>
export default {
    name: "Flats",
    props: {
        found: {
            type: Boolean,
            default: false,
        },
        list: {
            type: Array,
            default: [],
        }
    }
}
</script>

<style>
.el-card__body {
    font-size: 14px;
}
</style>
