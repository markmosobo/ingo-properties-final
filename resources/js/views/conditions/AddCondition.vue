<template>
    <TheMaster>
        <AddConditionForm />
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import AddConditionForm from "@/components/forms/AddConditionForm.vue";

export default {
   components : {
       TheMaster,
       AddConditionForm
   }
}
</script>