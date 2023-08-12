import {__} from "@/helpers/functions";

export interface ButtonProps {
    id?: string
    type?: 'button' | 'submit' | 'reset'
    label?: string
    class?: string
    loading?: boolean
}

export default function Button(props: ButtonProps) {
    return (
        <button
            type={props.type || 'button'}
            id={props.id}
            className={`btn btn-primary ${props.class}`}
            disabled={props.loading}
        >
            {/*{props.loading ? (<>
                <i className="fa fa-spinner fa-spin"></i> {__('Please wait...')}
            </>) : props.label}*/}
            {props.label}
        </button>
    );
}