<template>
  <div class="bg-white">
    <div class="flex pb-5 border-b bg-gray-50">
      <div class="w-full p-4 md:w-4/5 lg:w-3/5 md:mx-auto md:max-w-4xl">
        <div class="pt-4 pb-0">
          <div class="flex">
            <h2 class="flex-grow text-gray-900">
              Your Forms
            </h2>
            <v-button
              v-track.create_form_click
              :to="{ name: 'forms-create' }"
            >
              <svg
                class="inline w-4 h-4 mr-1 -mt-1 text-white"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.99996 1.1665V12.8332M1.16663 6.99984H12.8333"
                  stroke="currentColor"
                  stroke-width="1.67"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              Create a new form
            </v-button>
          </div>
          <small class="flex text-gray-500">Manage your forms and submissions.</small>
        </div>
      </div>
    </div>
    <div class="flex bg-white">
      <div class="w-full md:w-4/5 lg:w-3/5 md:mx-auto md:max-w-4xl">
        <div class="pb-0 mt-4">
          <text-input
            v-if="forms.length > 0"
            v-model="search"
            class="px-4 mb-6"
            name="search"
            label="Search a form"
            placeholder="Name of form to search"
          />
          <div
            v-if="allTags.length > 0"
            class="px-6 mb-4"
          >
            <div
              v-for="tag in allTags"
              :key="tag"
              :class="[
                'inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset cursor-pointer mr-2',
                {
                  'bg-blue-50 text-blue-600 ring-blue-500/10 dark:bg-blue-400':
                    selectedTags.has(tag),
                  'bg-gray-50 text-gray-600 ring-gray-500/10 dark:bg-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:ring-blue-500/10 hover:dark:bg-blue-400':
                    !selectedTags.has(tag),
                },
              ]"
              title="Click for filter by tag(s)"
              @click="onTagClick(tag)"
            >
              {{ tag }}
            </div>
          </div>
          <div
            v-if="!formsLoading && enrichedForms.length === 0"
            class="flex flex-wrap justify-center max-w-4xl"
          >
            <img
              class="w-56"
              src="/img/pages/forms/search_notfound.png"
              alt="search-not-found"
            >

            <h3 class="w-full mt-4 font-semibold text-center text-gray-900">
              No forms found
            </h3>
            <div
              v-if="isFilteringForms && enrichedForms.length === 0 && search"
              class="w-full mt-2 text-center"
            >
              Your search "{{ search }}" did not match any forms. Please try
              again.
            </div>
            <v-button
              v-if="forms.length === 0"
              v-track.create_form_click
              class="mt-4"
              :to="{ name: 'forms-create' }"
            >
              <svg
                class="inline w-4 h-4 mr-1 -mt-1 text-white"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.99996 1.1665V12.8332M1.16663 6.99984H12.8333"
                  stroke="currentColor"
                  stroke-width="1.67"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              Create a new form
            </v-button>
          </div>
          <div
            v-else-if="forms.length > 0"
            class="mb-10"
          >
            <div v-if="enrichedForms && enrichedForms.length">
              <div
                v-for="(form) in enrichedForms"
                :key="form.id"
                class="relative flex items-center p-4 mt-4 bg-white group hover:bg-gray-50 dark:bg-notion-dark"
              >
                <div
                  class="relative items-center flex-grow truncate cursor-pointer"
                >
                  <NuxtLink
                    :to="{name:'forms-slug-show-submissions', params: {slug:form.slug}}"
                    class="absolute inset-0"
                  />
                  <span class="font-semibold text-gray-900 dark:text-white">{{
                    form.title
                  }}</span>
                  <ul class="flex gap-4 text-sm text-gray-500">
                    <li class="pr-1 mr-3">
                      {{ form.views_count }} view{{
                        form.views_count > 0 ? "s" : ""
                      }}
                    </li>
                    <li class="mr-3 list-disc">
                      {{ form.submissions_count }}
                      submission{{ form.submissions_count > 0 ? "s" : "" }}
                    </li>
                    <li class="mr-3 list-disc">
                      Edited {{ form.last_edited_human }}
                    </li>
                    <li
                      v-if="form.creator"
                      class="hidden list-disc lg:list-item"
                    >
                      By
                      {{ form?.creator?.name }}
                    </li>
                  </ul>
                  <div
                    v-if="['draft','closed'].includes(form.visibility) || (form.tags && form.tags.length > 0)"
                    class="flex flex-wrap items-center gap-3 mt-1"
                  >
                    <span
                      v-if="form.visibility=='draft'"
                      class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-600 bg-yellow-100 rounded-full ring-1 ring-inset ring-gray-500/10 dark:text-white dark:bg-gray-700"
                    >
                      Draft
                    </span>
                    <span
                      v-else-if="form.visibility=='closed'"
                      class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-600 bg-yellow-100 rounded-full ring-1 ring-inset ring-gray-500/10 dark:text-white dark:bg-gray-700"
                    >
                      Closed
                    </span>
                    <span
                      v-for="(tag) in form.tags"
                      :key="tag"
                      class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 rounded-full bg-gray-50 ring-1 ring-inset ring-gray-500/10 dark:text-white dark:bg-gray-700"
                    >
                      {{ tag }}
                    </span>
                  </div>
                </div>
                <extra-menu
                  :form="form"
                  :is-main-page="true"
                />
              </div>
            </div>
            <div
              v-if="!workspace.is_pro"
              class="px-4"
            >
              <UAlert
                class="p-4 mt-8"
                icon="i-heroicons-sparkles"
                color="primary"
                variant="subtle"
                description="You can add components to your app using the cli."
              >
                <template #title>
                  <h3 class="font-semibold text-md">
                    Discover our Pro plan
                  </h3>
                </template>
                <template #description>
                  <div class="flex flex-wrap items-start gap-4 sm:flex-nowrap">
                    <p class="flex-grow">
                      Remove NoteForms branding, customize forms further, use your custom domain, integrate with your
                      favorite tools, invite users, and more!
                    </p>
                    <UButton
                      v-track.upgrade_banner_home_click
                      color="white"
                      class="block"
                      @click.prevent="subscriptionModalStore.openModal()"
                    >
                      Upgrade Now
                    </UButton>
                  </div>
                </template>
              </UAlert>
            </div>
          </div>
          <div
            v-if="formsLoading"
            class="text-center"
          >
            <Loader class="w-6 h-6 mx-auto text-nt-blue" />
          </div>
        </div>
      </div>
    </div>
    <open-form-footer class="mt-8 border-t" />
  </div>
</template>

<script setup>
import {useFormsStore} from "../stores/forms"
import {useWorkspacesStore} from "../stores/workspaces"
import Fuse from "fuse.js"
import TextInput from "../components/forms/TextInput.vue"
import ExtraMenu from "../components/pages/forms/show/ExtraMenu.vue"
import {refDebounced} from "@vueuse/core"

definePageMeta({
  middleware: ["auth", "self-hosted-credentials"],
})

useOpnSeoMeta({
  title: "Your Forms",
  description:
    "All of your vsForms are here. Create new forms, or update your existing forms.",
})

const subscriptionModalStore = useSubscriptionModalStore()
const formsStore = useFormsStore()
const workspacesStore = useWorkspacesStore()
formsStore.startLoading()

const workspace = computed(() => workspacesStore.getCurrent)

onMounted(() => {
  if (!formsStore.allLoaded) {
    formsStore.loadAll(workspacesStore.currentId)
  } else {
    formsStore.stopLoading()
  }
})

// State
const {
  getAll: forms,
  loading: formsLoading,
  allTags,
} = storeToRefs(formsStore)
const search = ref("")
const debouncedSearch = refDebounced(search, 500)
const selectedTags = ref(new Set())

// Methods

const onTagClick = (tag) => {
  if (selectedTags?.value?.has(tag)) {
    selectedTags.value.remove(tag)
  } else {
    selectedTags.value.add(tag)
  }
}

// Computed
const isFilteringForms = computed(() => {
  return (
    (search.value !== "" && search.value !== null) ||
    selectedTags.value.size > 0
  )
})

const enrichedForms = computed(() => {
  const enrichedForms = forms.value.map((form) => {
    form.workspace = workspacesStore.getByKey(form.workspace_id)
    return form
  }).filter((form) => {
    if (selectedTags.value.size === 0) {
      return true
    }
    return form.tags && form.tags.length ? [...selectedTags.value].every(r => form.tags.includes(r)) : false
  })

  if (!isFilteringForms || search.value === "" || search.value === null) {
    return enrichedForms
  }

  // Fuze search
  const fuzeOptions = {
    keys: ["title", "slug", "tags"],
  }
  const fuse = new Fuse(enrichedForms, fuzeOptions)
  return fuse.search(debouncedSearch.value).map((res) => {
    return res.item
  })
})
</script>
