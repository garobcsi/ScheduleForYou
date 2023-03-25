<script>
export default {
    props: {
        color: String,
    }
}
</script>

<template>
    <div :class="'alert-'+this.color" class="alert alert-dismissible fade show mb-0" role="alert">
        <slot></slot>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</template>

<style scoped>
    .alert {
        font-size: 85%;
        position: fixed;
        margin-left: 10px;
        margin-right: 10px;
        bottom: 10px;
        right: 0;
    }
</style>
