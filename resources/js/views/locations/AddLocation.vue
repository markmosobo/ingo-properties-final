<template>
    <TheMaster>
        <AddLocationForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import AddLocationForm from "@/components/forms/AddLocationForm.vue";

export default {
   components : {
       TheMaster,
       AddLocationForm
   }
}
</script>