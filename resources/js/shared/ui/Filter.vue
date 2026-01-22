<script setup>
import { Search, File } from 'lucide-vue-next';

</script>

<template>
  <label class="input">
  <Search class="h-[1em] opacity-50" />
  <input type="search" class="grow" placeholder="Search" />
  <kbd class="kbd kbd-sm">⌘</kbd>
  <kbd class="kbd kbd-sm">K</kbd>
</label>
<label class="input">
  <File class="h-[1em] opacity-50" />
  <input type="text" class="grow" placeholder="index.php" />
</label>
<label class="input">
  Path
  <input type="text" class="grow" placeholder="src/app/" />
  <span class="badge badge-neutral badge-xs">Optional</span>
</label>
</template>
