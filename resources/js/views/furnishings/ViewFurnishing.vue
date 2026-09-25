<template>
    <TheMaster>
        <AddFurnishingForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import AddFurnishingForm from "@/components/forms/AddFurnishingForm.vue";

export default {
   components : {
       TheMaster,
       AddFurnishingForm
   }
}
</script>