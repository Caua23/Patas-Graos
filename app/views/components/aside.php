
<aside>
    <ul>
        <li onclick="location.href='<?php echo $basePath; ?>/catalogo?type=destaques'">
            <button>
                <i data-lucide="star"> </i>
                <span>Destaques</span>
            </button>
        </li>
        <li onclick="location.href='<?php echo $basePath; ?>/catalogo?type=bebidas'">
            <button>
                <i data-lucide="coffee"> </i>
                <span>Bebidas</span>
            </button>
        </li>
        <li onclick="location.href='<?php echo $basePath; ?>/catalogo?type=salgados'">
            <button>
                <i data-lucide="croissant"> </i>
                <span>Salgados</span>
            </button>
        </li>
        <li onclick="location.href='<?php echo $basePath; ?>/catalogo?type=doces'">
            <button>
                <i data-lucide="cake-slice"> </i>
                <span>Doces</span>
            </button>
        </li>
        <li onclick="location.href='<?php echo $basePath; ?>/catalogo?type=jardim_felino'">
            <button>
                <i data-lucide="cat"> </i>
                <span>Jardim Felino</span>
            </button>
        </li>
    </ul>
    <div>
        <p>0.1V</p>
    </div>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        lucide.createIcons();
    </script>
</aside>