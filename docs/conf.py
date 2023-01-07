# Configuration file for the Sphinx documentation builder.

# -- Project information

project = 'WIP'
copyright = '2023, WIP'
author = 'WIP'

release = '0.1'
version = '0.1.0'

# -- General configuration

extensions = [
    'myst_parser',
    'sphinx.ext.autodoc',
    'sphinx.ext.autosummary',
    'sphinx.ext.doctest',
    'sphinx.ext.duration',
    'sphinx.ext.intersphinx',
]

intersphinx_mapping = {
    'python': ('https://docs.python.org/3/', None),
    'sphinx': ('https://www.sphinx-doc.org/en/master/', None),
}
intersphinx_disabled_domains = ['std']

templates_path = ['_templates']

# -- Options for HTML output

html_theme = 'sphinx_rtd_theme'
html_logo = 'https://payum.forma-pro.com/assets/images/logo-payum-264x128.png'
html_theme_options = {
    'logo_only': True,
    'collapse_navigation': False,
    'style_external_links': True
}

# -- Options for EPUB output
epub_show_urls = 'footnote'
