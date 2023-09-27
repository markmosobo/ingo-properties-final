<template>
    <TheMaster>
        <AddPropertyTypeForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import AddPropertyTypeForm from "@/components/forms/AddPropertyTypeForm.vue";

export default {
   components : {
       TheMaster,
       AddPropertyTypeForm
   }
}
</script>