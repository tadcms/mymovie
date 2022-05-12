<?php

namespace Juzaweb\CMS\Support\Theme;

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\View\ViewFinderInterface;
use Juzaweb\CMS\Contracts\ThemeContract;
use Juzaweb\CMS\Exceptions\ThemeNotFoundException;
use Noodlehaus\Config;

class Theme implements ThemeContract
{
    /**
     * Theme Root Path.
     *
     * @var string
     */
    protected string $basePath;

    /**
     * Blade View Finder.
     *
     * @var \Illuminate\View\ViewFinderInterface
     */
    protected ViewFinderInterface $finder;

    /**
     * Application Container.
     *
     * @var \Illuminate\Container\Container
     */
    protected Container $app;

    /**
     * Translator.
     *
     * @var \Illuminate\Translation\Translator
     */
    protected Translator|\Illuminate\Translation\Translator $lang;

    /**
     * Config.
     *
     * @var Repository
     */
    protected Repository $config;

    /**
     * Current Active Theme.
     *
     * @var string
     */
    private ?string $activeTheme = null;

    /**
     * Theme constructor.
     *
     * @param Container           $app
     * @param ViewFinderInterface $finder
     * @param Repository          $config
     * @param Translator          $lang
     */
    public function __construct(
        Container $app,
        ViewFinderInterface $finder,
        Repository $config,
        Translator $lang
    ) {
        $this->config = $config;
        $this->app = $app;
        $this->finder = $finder;
        $this->lang = $lang;
        $this->basePath = config('juzaweb.theme.path');
    }

    /**
     * Set current theme.
     *
     * @param string $theme
     *
     * @return void
     */
    public function set(string $theme): void
    {
        if (! $this->has($theme)) {
            throw new ThemeNotFoundException($theme);
        }

        $this->loadTheme($theme);
        $this->activeTheme = $theme;
    }

    /**
     * Check if theme exists.
     *
     * @param string $theme
     *
     * @return bool
     */
    public function has(string $theme): bool
    {
        $themeConfigPath = $this->getThemePath($theme) . '/theme.json';

        return file_exists($themeConfigPath);
    }

    public function getThemePath($theme, $path = ''): string
    {
        $result = $this->basePath . '/' . $theme;

        if (empty($path)) {
            return $result;
        }

        return $result . '/' . $path;
    }

    /**
     * Get particular theme all information.
     *
     * @param string $theme
     *
     * @return false|Config
     */
    public function getThemeInfo($theme): bool|Config
    {
        $themePath = $this->getThemePath($theme);
        $themeConfigPath = $themePath . '/theme.json';
        $themeChangelogPath = $themePath . '/changelog.yml';

        if (file_exists($themeConfigPath)) {
            $themeConfig = Config::load($themeConfigPath);
            $themeConfig['changelog'] = Config::load($themeChangelogPath)->all();
            $themeConfig['path'] = $themePath;
            $themeConfig['screenshot'] = $this->getScreenshot($theme);

            if ($themeConfig->has('name')) {
                return $themeConfig;
            }
        }

        return false;
    }

    /**
     * Returns current theme or particular theme information.
     *
     * @param string|null $theme
     * @param bool $collection
     *
     * @return array|null
     */
    public function get(string $theme = null, bool $collection = false): ?array
    {
        if (is_null($theme) || ! $this->has($theme)) {
            if ($collection) {
                return $this->getThemeInfo($this->activeTheme)->all();
            }

            return $this->getThemeInfo($this->activeTheme)->all();
        }

        if ($collection) {
            return $this->getThemeInfo($theme)->all();
        }

        return $this->getThemeInfo($theme)->all();
    }

    /**
     * Get current active theme name only or themeinfo collection.
     *
     * @param bool $collection
     *
     * @return null
     */
    public function current($collection = false)
    {
        return ! $collection ? $this->activeTheme : $this->getThemeInfo($this->activeTheme);
    }

    /**
     * Get all theme information.
     *
     * @param boolean $assoc
     * @return array
     */
    public function all(bool $assoc = false)
    {
        $themeDirectories = File::directories($this->basePath);
        $themes = [];
        foreach ($themeDirectories as $theme) {
            $themeConfig = $this->getThemeInfo(basename($theme));
            if (empty($themeConfig)) {
                continue;
            }

            $themes[$themeConfig->get('name')] = $assoc ? $themeConfig->all() : $themeConfig;
        }

        return $themes;
    }

    public function publicPath($theme): string
    {
        return public_path('jw-styles/themes/' . $theme);
    }

    public function assetsUrl($theme, $secure = null): string
    {
        return asset('jw-styles/themes/' . $theme . '/assets', $secure);
    }

    /**
     * Find asset file for theme asset.
     *
     * @param string $path
     * @param string $theme
     * @param null|bool $secure
     *
     * @return string
     */
    public function assets($path, $theme = null, $secure = null): string
    {
        if (empty($theme)) {
            $theme = $this->activeTheme;
        }

        return $this->assetsUrl($theme, $secure) . '/' . $path;
    }

    /**
     * Find theme asset from theme directory.
     *
     * @param string $path
     * @param string $theme
     *
     * @return string|false
     */
    public function getFullPath($path, $theme = null): bool|string
    {
        $splitThemeAndPath = explode(':', $path);

        if (count($splitThemeAndPath) > 1) {
            if (is_null($splitThemeAndPath[0])) {
                return false;
            }
            $themeName = $splitThemeAndPath[0];
            $path = $splitThemeAndPath[1];
        } else {
            $themeName = $this->activeTheme;
            $path = $splitThemeAndPath[0];
        }

        $themeInfo = $this->getThemeInfo($themeName);
        $themePath = str_replace(
            base_path('public') . DIRECTORY_SEPARATOR,
            '',
            $themeInfo->get('path')
        ) . DIRECTORY_SEPARATOR;

        $assetPath = $this->config['theme.folders.assets'] . DIRECTORY_SEPARATOR;
        $fullPath = $themePath . $assetPath . $path;

        if (! file_exists($fullPath) && $themeInfo->has('parent') && ! empty($themeInfo->get('parent'))) {
            $themePath = str_replace(
                base_path(). DIRECTORY_SEPARATOR,
                '',
                $this->getThemeInfo(
                    $themeInfo->get('parent')
                )->get('path')
            ) . DIRECTORY_SEPARATOR;

            return $themePath . $assetPath . $path;
        }

        return $fullPath;
    }

    /**
     * Get the current theme path to a versioned Mix file.
     *
     * @param string $path
     * @param string $manifestDirectory
     *
     * @return \Illuminate\Support\HtmlString|string
     * @throws \Exception
     */
    public function themeMix($path, $manifestDirectory = '')
    {
        return mix($this->getFullPath($path), $manifestDirectory);
    }

    public function getScreenshot($theme): string
    {
        $path = $this->getThemePath($theme, 'assets/public/images/screenshot.png');
        if (file_exists($path)) {
            return theme_assets('images/screenshot.png', $theme);
        }

        return asset('jw-styles/juzaweb/images/screenshot.svg');
    }

    public function getVersion($theme): string
    {
        $info = $this->getThemeInfo($theme);
        return $info->get('version', '0');
    }

    public function getTemplates($theme, $template = null)
    {
        if ($template) {
            return Arr::get($this->getRegister($theme), "templates.{$template}");
        }

        return $this->getRegister($theme, 'templates');
    }

    public function getRegister($theme, $key = null): string|array
    {
        $path = $this->getThemePath($theme, 'register.json');
        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path), true);
            if ($key) {
                return Arr::get($data, $key);
            }

            return $data;
        }

        return [];
    }

    /**
     * Map view map for particular theme.
     *
     * @param string $theme
     *
     * @return void
     */
    protected function loadTheme($theme): void
    {
        if (is_null($theme)) {
            return;
        }

        $themeInfo = $this->getThemeInfo($theme);
        if (is_null($themeInfo)) {
            return;
        }

        $hasParent = false;
        if ($parent = $themeInfo->get('parent')) {
            $this->loadTheme($parent);
            $hasParent = true;
        }

        $viewPath = $themeInfo->get('path') . '/views';
        $langPath = $themeInfo->get('path') .'/lang';

        $viewPublishPath = resource_path('views/themes/' . $theme);
        $langPublishPath = resource_path('lang/themes/' . $theme);

        $namespace = 'theme';
        if ($hasParent) {
            $this->finder->prependNamespace($namespace, $viewPath);
        } else {
            $this->finder->addNamespace($namespace, $viewPath);
        }

        if (is_dir($viewPublishPath)) {
            $this->finder->addNamespace($namespace, $viewPath);
        }

        $this->lang->addNamespace($namespace, $langPath);

        if (is_dir($langPublishPath)) {
            $this->lang->addNamespace($namespace, $langPublishPath);
        }
    }
}
