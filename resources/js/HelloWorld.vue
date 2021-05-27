<template>
    <div>
        {{ msg }}
    </div>
</template>

<script>
export default {
    setup() {
        const msg = "hello";
        return { msg };
    }
};
</script>
