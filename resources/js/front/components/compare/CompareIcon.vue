<template>
    <div class="dropdown cart-dropdown">
        <a href="/compare" class="header-icon header-icon-link">
            <span class="dropdown-icon-box">
                <img src="/images/icons/header-compare-icon.svg" alt="" class="dropdown-icon" />
                <span class="cart-count badge-circle">{{ $store.getters.compareTotalCount }}</span>
            </span>
            <span class="icon-text">Համեմատել</span>
        </a>
    </div>
</template>

