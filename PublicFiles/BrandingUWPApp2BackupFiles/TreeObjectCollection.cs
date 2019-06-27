using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace BrandingUWPApp2
{
    public class TreeObjectCollection<TypeName>
    {
        public TypeName data;
        public List<TreeObjectCollection<TypeName>> children;
        public ObservableCollection<TreeObjectCollection<TypeName>> observableChildren;
        public TreeObjectCollection<TypeName> parent = null;

        public TreeObjectCollection()
        {
            data = default(TypeName);
            children = new List<TreeObjectCollection<TypeName>>();
            observableChildren = new ObservableCollection<TreeObjectCollection<TypeName>>(children);
        }

        public TreeObjectCollection(TypeName newData)
        {
            data = newData;
            children = new List<TreeObjectCollection<TypeName>>();
            observableChildren = new ObservableCollection<TreeObjectCollection<TypeName>>(children);
        }

        public TreeObjectCollection(TypeName newData, TreeObjectCollection<TypeName> newParent)
        {
            data = newData;
            children = new List<TreeObjectCollection<TypeName>>();
            observableChildren = new ObservableCollection<TreeObjectCollection<TypeName>>(children);
            parent = newParent;
        }

        public void AddChildNode(TreeObjectCollection<TypeName> newChild)
        {
            children.Add(newChild);
            observableChildren.Add(newChild);
        }

        public TypeName Traverse(TreeObjectCollection<TypeName> node)
        {
            for (int i = 0; i < node.children.Count; i++)
            {
                Traverse(node.children[i]);
            }
            return node.data;
        }

        public List<TypeName> ToList()
        {
            List<TypeName> treeAsList = new List<TypeName>();
            for (int i = 0; i < children.Count; i++)
            {
                treeAsList.Add(Traverse(children[i]));
            }
            return treeAsList;
        }
    }
}
