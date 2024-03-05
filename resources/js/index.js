import LabelStudio from '@heartexlabs/label-studio'
// import '@heartexlabs/label-studio/build/static/css/main.css'

export default function annotationPlugin(args) {
    return {
        state: args.state,
        mode: 'light',
        ls: null,
        config: args.config,
        interfaces: args.interfaces,
        user: args.user,
        task: args.task,
        name: args.name,
        init: function () {
            this.ls = new LabelStudio(this.name, {
                config: this.config,
                interfaces: this.interfaces,
                user: this.user,
                task: this.task,
                mode: 'dark',
                onLabelStudioLoad: function (LS) {
                    var c = LS.annotationStore.addAnnotation({
                        userGenerate: true,
                    })
                    LS.annotationStore.selectAnnotation(c.id)
                },
            })
        },
    }
}
