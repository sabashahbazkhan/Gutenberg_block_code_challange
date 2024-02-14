import "./index.scss"
import {useSelect} from "@wordpress/data"
import {useState, useEffect} from "react"
import apiFetch from "@wordpress/api-fetch"
import {useBlockProps} from "@wordpress/block-editor"
/*
Register block
*/
wp.blocks.registerBlockType("trewplugin/featured-author", {
  title: "Author Callout",
  description: "Add information anywhere about an author of your choice",
  icon: "nametag",
  category: "common",
  attributes: {
    authId: {type: "string"}
  },
  edit: EditComponent,
  save: function () {
    return null
  }
})
/*
This function is responsible for the
*/
function EditComponent(props) {
  const blockProps = useBlockProps({
    className: "featured-author-wrapper",
  })
  const [thePreview, setThePreview] = useState("")

  useEffect(() => {
    async function go() {
      const response = await apiFetch({
        path: `/featuredAuthor/v1/getHTML?authId=${props.attributes.authId}`,
        method: "GET"
      })
      setThePreview(response)
    }
    go()
  }, [props.attributes.authId])

  const allAuthor = useSelect(select => {
    return (select( 'core' ).getUsers({ who: 'authors' }))
  })



  if (allAuthor == undefined) return <p>Loading...</p>

  return (
    <div {...blockProps}>
      <div className="author-select-container">
        <h1>Add information anywhere about an author of your choice</h1>
        <select onChange={e => props.setAttributes({authId: e.target.value})}>
          <option value="">Select a author</option>
          {allAuthor.map(auth => {
            return (
              <option value={auth.id} selected={props.attributes.authId == auth.id}>
                {auth.username}
              </option>
            )
          })}
        </select>
      </div>
      <div>
        <div dangerouslySetInnerHTML={{__html: thePreview}}></div>
      </div>
    </div>
  )
}