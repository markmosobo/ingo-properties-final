<template>
    <TheMaster>
        <AddBlogCategoryForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import AddBlogCategoryForm from "@/components/forms/AddBlogCategoryForm.vue";

export default {
   components : {
       TheMaster,
       AddBlogCategoryForm
   }
}
</script>