<template>
    <TheMaster>
        <EditCategoryForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import EditCategoryForm from "@/components/forms/EditCategoryForm.vue";

export default {
   components : {
       TheMaster,
       EditCategoryForm
   }
}
</script>