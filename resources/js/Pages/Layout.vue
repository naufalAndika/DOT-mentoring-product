<template>
  <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <inertia-link class="navbar-brand" href="/">Products</inertia-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <article>
      <slot />
    </article>
  </main>
</template>

<script>
export default {
}
</script>
