<template>
    <TheMaster>
        <EditPropertyForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import EditPropertyForm from "@/components/forms/EditPropertyForm.vue";

export default {
   components : {
       TheMaster,
       EditPropertyForm
   }
}
</script>