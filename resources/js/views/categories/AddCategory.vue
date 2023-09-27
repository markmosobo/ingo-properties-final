<template>
    <TheMaster>
        <AddCategoryForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import AddCategoryForm from "@/components/forms/AddCategoryForm.vue";

export default {
   components : {
       TheMaster,
       AddCategoryForm
   }
}
</script>